<?php namespace ProIMAN\Http\Controllers\enroll;

use Illuminate\Support\Facades\DB;
use ProIMAN\Http\Requests;
use ProIMAN\Http\Controllers\Controller;
use ProIMAN\StudentEnroll;
use ProIMAN\UserDetail;
use ProIMAN\OurCourse;
use ProIMAN\Student;
use ProIMAN\Referer;
use ProIMAN\Http\Requests\setting\CreateStudentEnrollRequest;
use Illuminate\Session\Store as Session;

class EnrollStudentController extends Controller {
	/**
	 * @var array
	 */
	protected $pro_data;
	protected $studentEnroll;
	protected $session;

	/**
	 * Constructor.
	 *
	 * @param Session $session					The Session Class
	 * @param StudentEnroll $studentEnroll   	The StudentEnroll Model
	 *
	 * @api
	 */
	public function __construct(Session $session, StudentEnroll $studentEnroll)
	{

		$this->studentEnroll = $studentEnroll;
		$this->session = $session;

		//$session->clear();

		// set session for pop up message.
		$session->has('store_success_info')?$this->pro_data['store_success_info'] = $session->pull('store_success_info'):'';
		$session->has('update_success_info')?$this->pro_data['update_success_info'] = $session->pull('update_success_info'):'';
		$session->has('delete_success_info')?$this->pro_data['delete_success_info'] = $session->pull('delete_success_info'):'';
		$session->has('page_linker')?$this->pro_data['page_linker'] = $session->pull('page_linker'):'';

		$session->has('studentEnrollId')?$session->reflash('studentEnrollId'):''; // Re-flashing student enroll id for creating bill.
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$enrolledStudents = StudentEnroll::with('ourCourse','student.userDetail','studentBill')->get();
		$this->pro_data['enrollStudents'] = $enrolledStudents;
		$this->pro_data['ourCourses'] = OurCourse::whereStatus('0')->get();
		$this->pro_data['students'] = Student::with('userDetail')->whereStatus('0')->get();
		$this->pro_data['referers'] = Referer::with('userDetail')->whereStatus('0')->get();
		$this->pro_data['userId'] = $this->session->has('userId')?$this->session->get('userId'):0;
		return view('enroll.student.index',$this->pro_data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{

	}

	/**
	 * Store a newly created resource in storage.
	 * @param CreateStudentEnrollRequest $request
	 * @return Response
	 */
	public function store(CreateStudentEnrollRequest $request)
	{
		($request->get('status') == "on")?$status=0:$status=1;
		$studentEnrollSave = $this->studentEnroll->create([
			'student_id'=>$request->get('student_id'),
			'referer_id'=>$request->get('referer_id')=='0'?NULL:$request->get('referer_id'),
			'our_course_id'=>$request->get('our_course_id'),
			'enroll_date'=>$request->get('enroll_date'),
			'admin_note'=>$request->get('admin_note'),
			'account_note'=>$request->get('account_note'),
			'created_by'=>$request->user()->id,
			'updated_by'=>$request->user()->id,
			'status'=>$status
		]);
		$studentEnrollSaveId = $studentEnrollSave->id;

		$this->session->flash('page_linker','"'.route('enroll.enroll-student-bill.create').'"');
		$this->session->flash('studentEnrollId',''.$studentEnrollSaveId.'');
		return redirect()->route('enroll.student.index');
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
	 * @param  UserDetail $userDetail
	 * @return Response
	 */
	public function edit(UserDetail $userDetail)
	{

	}

	/**
	 * Update the specified resource in storage.
	 * @param  CreateStudentRequest $request, UserDetail $userDetail
	 * @return Response
	 */
	public function update(CreateStudentRequest $request, UserDetail $userDetail)
	{

	}

	/**
	 * Remove the specified resource from storage.
	 * @param UserDetail $userDetail
	 * @return Response
	 */
	public function destroy(UserDetail $userDetail)
	{
		$userName = $userDetail->getAttribute('name');
		$userDetail->delete();
		$this->session->flash('delete_success_info','" student named '.$userName.'"');
		return redirect()->route('student.index');
	}

	public function getAll(){
		return DB::table('pro_student_enroll')
			->leftJoin('pro_students',function($join){
				$join->on('pro_student_enroll.student_id','=','pro_students.id');
			})
			->leftJoin('pro_users_detail',function($join){
				$join->on('pro_students.user_id','=','pro_users_detail.id');
			})
			->leftJoin('pro_our_courses',function($join){
				$join->on('pro_student_enroll.our_course_id','=','pro_our_courses.id');
			})
			->leftJoin('pro_student_bills',function($join){
				$join->on('pro_student_enroll.id','=','pro_student_bills.student_enroll_id');
			})
			->select([
				'pro_users_detail.name as student_name',
				'pro_users_detail.address as student_address',
				'pro_our_courses.name as our_course_name',
				'pro_student_bills.student_enroll_id as student_enroll_id',
				'pro_student_enroll.*',
			])
			->whereNull('pro_student_enroll.deleted_at')
			->groupBy('student_enroll_id')
			->get();

	}
}
