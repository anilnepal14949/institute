<?php namespace ProIMAN\Http\Controllers\setting;

use ProIMAN\Http\Requests;
use ProIMAN\Http\Controllers\Controller;
use ProIMAN\Teacher;
use ProIMAN\UserDetail;
use ProIMAN\Http\Requests\setting\CreateTeacherRequest;
use Illuminate\Session\Store as Session;

class TeacherController extends Controller {

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
		$session->has('redirect_to')?$this->pro_data['redirect_to'] = $session->pull('redirect_to'):'';
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$teachers = $this->userDetail->whereUser_type(2)->orderBy('id','desc')->orderBy('updated_at','desc')->get();
		$this->pro_data['teachers'] = ($teachers->isEmpty())?'':$teachers;
		return view('setting.teacher.index',$this->pro_data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * @param CreateTeacherRequest $request
	 * @return Response
	 */
	public function store(CreateTeacherRequest $request)
	{
		($request->get('status') == "on")?$status=0:$status=1;

		$fileName = '';
		if($request->file('image')){
			$fileName = time().$request->file('image')->getClientOriginalName();
			$this->uploadImage('teacher',$fileName,$request->file('image'));
		}
		$teacherSave = $this->userDetail->create([
			'name'=>$request->get('name'),
			'address'=>$request->get('address'),
			'contact'=>$request->get('contact'),
			'gender'=>$request->get('gender'),
			'email'=>$request->get('email'),
			'dob'=>$request->get('dob'),
			'image'=>$fileName,
			'user_type'=>2,
			'created_by'=>$request->user()->id,
			'updated_by'=>$request->user()->id,
			'status'=>$status
		]);

		$user_id = $teacherSave->id;

		Teacher::create([
			'user_id'=>$user_id,
			'status'=>$status,
			'created_by'=>$request->user()->id,
			'updated_by'=>$request->user()->id,
			'extra_qualification'=>$request->get('extra_qualification'),
			'associated_in'=>$request->get('associated_in'),
			'qualification'=>$request->get('qualification')
		]);

		$this->session->flash('store_success_info','" teacher named '.$request->get('name').'"');
		return redirect()->route('teacher.index');
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
		$user_type = $userDetail->user_type;
		$this->pro_data['teachers'] = $userDetail->whereUser_type($user_type)->orderBy('id','desc')->orderBy('updated_at','desc')->get();
		$this->pro_data['teacher']  = $userDetail->teacher()->first();
		$this->pro_data['userDetail'] = $userDetail;

		return view('setting.teacher.edit',$this->pro_data);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  CreateTeacherRequest $request
	 * @param  UserDetail $userDetail
	 * @return Response
	 */
	public function update(CreateTeacherRequest $request, UserDetail $userDetail)
	{
		($request->get('status') == "on")?$status=0:$status=1;

		$fileName = $oldFileName = $userDetail->getAttribute('image');
		if($request->file('image')){
			$fileName = time().$request->file('image')->getClientOriginalName();
			$this->uploadImage('teacher',$fileName,$request->file('image'),$oldFileName);
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

		$teacherUpdate = $userDetail->teacher()->first();
		$teacherUpdate->fill([
			'status'=>$status,
			'updated_by'=>$request->user()->id,
			'extra_qualification'=>$request->get('extra_qualification'),
			'associated_in'=>$request->get('associated_in'),
			'qualification'=>$request->get('qualification')
		])->save();

		$this->session->flash('update_success_info','" teacher named '.$request->get('name').'"');
		return redirect()->route('teacher.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  UserDetail $userDetail
	 * @return Response
	 */
	public function destroy(UserDetail $userDetail)
	{
		$userName = $userDetail->getAttribute('name');
		$userDetail->delete();
		$this->session->flash('delete_success_info','" teacher named '.$userName.'"');
		return redirect()->route('teacher.index');
	}

}
