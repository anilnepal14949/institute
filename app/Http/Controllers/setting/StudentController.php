<?php namespace ProIMAN\Http\Controllers\setting;

use ProIMAN\Http\Requests;
use ProIMAN\Http\Controllers\Controller;
use ProIMAN\Student;
use ProIMAN\StudentEnroll;
use ProIMAN\UserDetail;
use ProIMAN\Http\Requests\setting\CreateStudentRequest;
use Illuminate\Session\Store as Session;

class StudentController extends Controller {
	/**
	 * @var array
	 */
	protected $pro_data;
	protected $session;
	protected $userDetail;

	/**
	 * Constructor.
	 *
	 * @param Session $session				The Session Class
	 * @param UserDetail $userDetail   		The UserDetail Model
	 *
	 * @api
	 */
	public function __construct(Session $session, UserDetail $userDetail)
	{

		$this->session = $session;
		$this->userDetail = $userDetail;

		//$session->clear();

		// set session for pop up message.
		$session->has('store_success_info')?$this->pro_data['store_success_info'] = $session->pull('store_success_info'):'';
		$session->has('update_success_info')?$this->pro_data['update_success_info'] = $session->pull('update_success_info'):'';
		$session->has('delete_success_info')?$this->pro_data['delete_success_info'] = $session->pull('delete_success_info'):'';
		$session->has('delete_file_success_info')?$this->pro_data['delete_file_success_info'] = $session->pull('delete_file_success_info'):'';
		$session->has('page_linker')?$this->pro_data['page_linker'] = $session->pull('page_linker'):'';
		$session->has('userId')?$session->reflash('userId'):''; // Re-flashing student id for enrollment
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$students = $this->userDetail->whereUser_type(3)->orderBy('id','desc')->orderBy('updated_at','desc')->get();
		$this->pro_data['students'] = ($students->isEmpty())?'':$students;
		return view('setting.student.index',$this->pro_data);
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
	 * @param CreateStudentRequest $request
	 * @return Response
	 */
	public function store(CreateStudentRequest $request)
	{
		($request->get('status') == "on")?$status=0:$status=1;

		$fileName = '';
		if($request->file('image')){
			$fileName = time().$request->file('image')->getClientOriginalName();
			$this->uploadImage('student',$fileName,$request->file('image'));
		}
		$studentSave = $this->userDetail->create([
			'name'=>$request->get('name'),
			'address'=>$request->get('address'),
			'contact'=>$request->get('contact'),
			'gender'=>$request->get('gender'),
			'email'=>$request->get('email'),
			'dob'=>$request->get('dob'),
			'image'=>$fileName,
			'user_type'=>3,
			'created_by'=>$request->user()->id,
			'updated_by'=>$request->user()->id,
			'status'=>$status
		]);

		$user_id = $studentSave->id;
		Student::create([
			'user_id'=>$user_id,
			'status'=>$status,
			'created_by'=>$request->user()->id,
			'updated_by'=>$request->user()->id,
			'parent_contact'=>$request->get('parent_contact'),
			'parent_name'=>$request->get('parent_name'),
			'parent_email'=>$request->get('parent_email'),
			'temp_parent_name'=>$request->get('temp_parent_name'),
			'temp_parent_contact'=>$request->get('temp_parent_contact'),
			'associated_to'=>$request->get('associated_to'),
			'qualification'=>$request->get('qualification'),
			'profession'=>$request->get('profession')
		]);

		$this->session->flash('store_success_info','" student named '.$request->get('name').'"');
		$this->session->flash('page_linker','"'.route('enroll.student.index').'"');
		$this->session->flash('userId',''.$user_id.'');
		return redirect()->route('student.index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  UserDetail $userDetail
	 * @return Response
	 */
	public function show(UserDetail $userDetail)
	{
		$user_type = $userDetail->user_type;
		$student_detail = $userDetail->student()->first();
		$this->pro_data['students'] = $userDetail->whereUser_type($user_type)->orderBy('id','desc')->orderBy('updated_at','desc')->get();
		$this->pro_data['student']  = $student_detail;

		$student_enroll =  StudentEnroll::where('student_id',$student_detail->id)->first();
		if($student_enroll == null){
			$this->pro_data['student_enroll_id']  = 0;
		}else{
			$this->pro_data['student_enroll_id']  = $student_enroll->id;
		}

		$this->pro_data['userDetail'] = $userDetail;
		$this->pro_data['userView'] = $student_detail->id;
		return view('setting.student.view',$this->pro_data);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  UserDetail $userDetail
	 * @return Response
	 */
	public function edit(UserDetail $userDetail)
	{
		$user_type = $userDetail->user_type;
		$this->pro_data['students'] = $userDetail->whereUser_type($user_type)->orderBy('id','desc')->orderBy('updated_at','desc')->get();
		$this->pro_data['student']  = $userDetail->student()->first();

		$this->pro_data['userDetail'] = $userDetail;
		return view('setting.student.edit',$this->pro_data);
	}

	/**
	 * Update the specified resource in storage.
	 * @param  CreateStudentRequest $request
	 * @param  UserDetail $userDetail
	 * @return Response
	 */
	public function update(CreateStudentRequest $request, UserDetail $userDetail)
	{
		($request->get('status') == "on")?$status=0:$status=1;

		$fileName = $oldFileName = $userDetail->getAttribute('image');
		if($request->file('image')){
			$fileName = time().$request->file('image')->getClientOriginalName();
			$this->uploadImage('student',$fileName,$request->file('image'),$oldFileName);
		}

		$userType = $userDetail->getAttribute('user_type');
		$userDetail->fill([
			'name'=>$request->get('name'),
			'address'=>$request->get('address'),
			'contact'=>$request->get('contact'),
			'gender'=>$request->get('gender'),
			'email'=>$request->get('email'),
			'dob'=>$request->get('dob'),
			'image'=>$fileName,
			'user_type'=>$userType,
			'updated_by'=>$request->user()->id,
			'status'=>$status
		])->save();

		$studentUpdate = $userDetail->student()->first();
		$studentUpdate->fill([
			'status'=>$status,
			'updated_by'=>$request->user()->id,
			'parent_contact'=>$request->get('parent_contact'),
			'parent_name'=>$request->get('parent_name'),
			'parent_email'=>$request->get('parent_email'),
			'temp_parent_name'=>$request->get('temp_parent_name'),
			'temp_parent_contact'=>$request->get('temp_parent_contact'),
			'associated_to'=>$request->get('associated_to'),
			'qualification'=>$request->get('qualification'),
			'profession'=>$request->get('profession')
		])->save();

		$this->session->flash('update_success_info','" student named '.$request->get('name').'"');
		return redirect()->route('student.index');
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

}
