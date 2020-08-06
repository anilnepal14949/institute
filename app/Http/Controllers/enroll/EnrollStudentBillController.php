<?php namespace ProIMAN\Http\Controllers\enroll;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use ProIMAN\Http\Requests;
use ProIMAN\Http\Controllers\Controller;
use ProIMAN\Receipt;
use ProIMAN\ReceiptDetail;
use ProIMAN\StudentBill;
use Illuminate\Session\Store as Session;

class EnrollStudentBillController extends Controller {
	/**
	 * @var array
	 */
	protected $pro_data;
	protected $studentBill;
	protected $session;
	protected $studentEnrollInfo;

	/**
	 * Constructor.
	 *
	 * @param Session $session					The Session Class
	 * @param StudentBill $studentBill			The StudentBill Model
	 * @api
	 */
	public function __construct(Session $session, StudentBill $studentBill)
	{

		$this->session = $session;
		$this->studentBill = $studentBill;

		//$session->clear();

		// set session for pop up message.
		$session->has('store_success_info')?$this->pro_data['store_success_info'] = $session->get('store_success_info'):'';
		$session->has('update_success_info')?$this->pro_data['update_success_info'] = $session->get('update_success_info'):'';
		$session->has('delete_success_info')?$this->pro_data['delete_success_info'] = $session->get('delete_success_info'):'';
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$billInfo = DB::table('pro_student_bills')
			->leftJoin('pro_students',function($join){
				$join->on('pro_student_bills.student_id','=','pro_students.id');
			})
			->leftJoin('pro_users_detail',function($join){
				$join->on('pro_students.user_id','=','pro_users_detail.id');
			})
			->leftJoin('pro_student_enroll',function($join){
				$join->on('pro_student_bills.student_enroll_id','=','pro_student_enroll.id');
			})
			->leftJoin('pro_our_courses',function($join){
				$join->on('pro_student_enroll.our_course_id','=','pro_our_courses.id');
			})
			->select([
				'pro_student_bills.*',
				'pro_users_detail.name',
				'pro_users_detail.address',
				'pro_users_detail.contact',
				'pro_our_courses.name as course_name'
			])
			->where('pro_student_bills.due','>','0')
			->whereNull('pro_student_bills.deleted_at')
            ->orderBy('id','desc')
			->get();

		$this->pro_data['bills'] = $billInfo;
		return view('enroll.student-bill.index',$this->pro_data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{

		if($this->session->has('studentEnrollId')){
			$studentEnrollId = $this->session->get('studentEnrollId');
			$studentEnrollInfo = $this->getInfo($studentEnrollId);
			$this->studentEnrollInfo = $studentEnrollInfo;
			$this->storeIntoBill($studentEnrollId);
		}elseif(Input::get('student_enroll_id')){
			$studentEnrollId = Input::get('student_enroll_id');
			$studentEnrollInfo = $this->getInfo($studentEnrollId);

		}else{
			$studentEnrollId = $this->session->get('studentEnrollIdSecond');
			$studentEnrollInfo = $this->getInfo($studentEnrollId);
		}

		$this->pro_data['bill_data'] = $this->studentBill->whereStudent_id($studentEnrollInfo->student_id)->with('ourCourse')->where('due','>','0')->orderBy('id','desc')->get();
		$this->pro_data['studentEnrollInfo'] = $studentEnrollInfo;
		$studentReceipts = Receipt::whereStudent_id($studentEnrollInfo->student_id)->get();
		$this->pro_data['studentReceipts'] = $studentReceipts->isEmpty()?'':$studentReceipts;
		return view('enroll.student-bill.receipt',$this->pro_data);
	}

	/**
	 * Store a newly created resource in storage.
	 * @return Response
	 */
	public function store()
	{
		$studentEnrollId = Input::get('student_enroll_id');
		$studentEnrollInfo = $this->getInfo($studentEnrollId);
		$this->studentEnrollInfo = $studentEnrollInfo;
		$this->storeIntoBill($studentEnrollId);

		$this->pro_data['bill_data'] = $this->studentBill->whereStudent_id($studentEnrollInfo->student_id)->where('due','>','0')->orderBy('id','desc')->get();

		$this->pro_data['studentEnrollInfo'] = $studentEnrollInfo;
		$studentReceipts = Receipt::whereStudent_id($studentEnrollInfo->student_id)->get();
		$this->pro_data['studentReceipts'] = $studentReceipts->isEmpty()?'':$studentReceipts;
		return view('enroll.student-bill.receipt',$this->pro_data);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @return Response
	 */
	public function edit()
	{

	}

	/**
	 * @param int $id
	 * Update the specified resource in storage.
	 * @return Response
	 */
	public function update($id)
	{
		$updated_data = Input::all();
		$bill_ids = $this->studentBill->whereStudent_id($id)->where('due','>','0')->orderBy('id','desc')->lists('id');
		$i = 0;

		$authId = Auth::user()->id;
		$receiptSave = Receipt::create([
			'student_id'=>$id,
			'receipt_note'=>$updated_data['receipt_note'],
			'created_by'=>$authId,
			'updated_by'=>$authId,
			'status'=>'0'
		]);

		$receiptId = $receiptSave->id;

		foreach($bill_ids as $bill_id){
			$bill_detail = $this->studentBill->find($bill_id);

			$bill_detail->fill([
				'due'=>$updated_data['bill_amount_due'][$i]
			])->save();

			ReceiptDetail::create([
				'receipt_id'=>$receiptId,
				'bill_no'=>$bill_id, // bill no => bill NO id
				'paid_amount'=>$updated_data['bill_amount_paid'][$i],
				'discount_amount'=>$updated_data['bill_amount_discount'][$i++],
				'created_by'=>$authId,
				'updated_by'=>$authId,
				'status'=>'0'
			]);
		}

		$this->pro_data['receiptDetail'] = Receipt::whereId($receiptId)->with('receiptDetail','student.userDetail')->first();
		return view('enroll.student-bill.print_receipt',$this->pro_data);
	}

	/**
	 * Remove the specified resource from storage.
	 * @return Response
	 */
	public function destroy()
	{

	}

    public function getInfo($studentEnrollId){
        return DB::table('pro_student_enroll')
            ->leftJoin('pro_our_courses',function($join){
                $join->on('pro_student_enroll.our_course_id','=','pro_our_courses.id');
            })
            ->leftJoin('pro_students',function($join){
                $join->on('pro_students.id','=','pro_student_enroll.student_id');
            })
            ->leftJoin('pro_users_detail',function($join){
                $join->on('pro_students.user_id','=','pro_users_detail.id');
            })
            ->select([
                'pro_student_enroll.our_course_id',
                'pro_student_enroll.student_id',
                'pro_student_enroll.account_note',
                'pro_our_courses.course_fee',
                'pro_our_courses.form_fee',
                'pro_our_courses.name as course_name',
                'pro_student_enroll.id as student_enroll_id',
                'pro_users_detail.name',
                'pro_students.user_id',
                'pro_users_detail.address',
                'pro_users_detail.contact',
                'pro_users_detail.email'
            ])
            ->where('pro_student_enroll.id',$studentEnrollId)
            ->first();

    }

	public function storeIntoBill($studentEnrollId){
		$authId = Auth::user()->id;
		$studentEnrollInfo = $this->studentEnrollInfo;
		$billNo = $this->studentBill->max('bill_no')+1;
		$this->studentBill->create([
			'bill_no'=>$billNo,
			'bill_type'=>'0',
			'student_id'=>$studentEnrollInfo->student_id,
			'our_course_id'=>$studentEnrollInfo->our_course_id,
			'student_enroll_id'=>$studentEnrollId,
			'amount'=>$studentEnrollInfo->course_fee,
			'tax'=>'',
			'due'=>$studentEnrollInfo->course_fee,
			'created_by'=>$authId,
			'updated_by'=>$authId,
			'status'=>'0'
		]);

		if($studentEnrollInfo->form_fee != NULL){
			$this->studentBill->create([
				'bill_no'=>$billNo,
				'bill_type'=>'1',
				'student_id'=>$studentEnrollInfo->student_id,
				'our_course_id'=>$studentEnrollInfo->our_course_id,
				'student_enroll_id'=>$studentEnrollId,
				'amount'=>$studentEnrollInfo->form_fee,
				'tax'=>'',
				'due'=>$studentEnrollInfo->form_fee,
				'created_by'=>$authId,
				'updated_by'=>$authId,
				'status'=>'0'
			]);
		}
		$this->session->put('studentEnrollIdSecond',$studentEnrollId);
	}
}
