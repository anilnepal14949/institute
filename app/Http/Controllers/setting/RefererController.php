<?php namespace ProIMAN\Http\Controllers\setting;

use ProIMAN\Http\Requests;
use ProIMAN\Http\Controllers\Controller;
use ProIMAN\Referer;
use ProIMAN\UserDetail;
use ProIMAN\Http\Requests\setting\CreateRefererRequest;
use Illuminate\Session\Store as Session;

class RefererController extends Controller {
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
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$referers = $this->userDetail->whereUser_type(4)->orderBy('id','desc')->get();
		$this->pro_data['referers'] = ($referers->isEmpty())?'':$referers;
		return view('setting.referer.index',$this->pro_data);
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
	 * @param CreateRefererRequest $request
	 * @return Response
	 */
	public function store(CreateRefererRequest $request)
	{
		($request->get('status') == "on")?$status=0:$status=1;

		$fileName = '';
		if($request->file('image')){
			$fileName = time().$request->file('image')->getClientOriginalName();
			$this->uploadImage('referer',$fileName,$request->file('image'));
		}
		$refererSave = $this->userDetail->create([
			'name'=>$request->get('name'),
			'address'=>$request->get('address'),
			'contact'=>$request->get('contact'),
			'gender'=>$request->get('gender'),
			'email'=>$request->get('email'),
			'dob'=>$request->get('dob'),
			'image'=>$fileName,
			'user_type'=>4,
			'created_by'=>$request->user()->id,
			'updated_by'=>$request->user()->id,
			'status'=>$status
		]);

		$user_id = $refererSave->id;
		Referer::create([
			'user_id'=>$user_id,
			'status'=>$status,
			'created_by'=>$request->user()->id,
			'updated_by'=>$request->user()->id,
			'qualification'=>$request->get('qualification'),
			'relation'=>$request->get('relation'),
			'profession'=>$request->get('profession'),
			'description'=>$request->get('description')
		]);

		$this->session->flash('store_success_info','" referer named '.$request->get('name').'"');
		return redirect()->route('referer.index');
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
		$this->pro_data['referers'] = $userDetail->whereUser_type($user_type)->orderBy('id','desc')->get();
		$this->pro_data['referer']  = $userDetail->referer()->first();
		$this->pro_data['userDetail'] = $userDetail;
		return view('setting.referer.edit',$this->pro_data);
	}

	/**
	 * Update the specified resource in storage.
	 * @param  CreateRefererRequest $request
	 * @param  UserDetail $userDetail
	 * @return Response
	 */
	public function update(CreateRefererRequest $request, UserDetail $userDetail)
	{
		($request->get('status') == "on")?$status=0:$status=1;

		$fileName = $oldFileName = $userDetail->getAttribute('image');
		if($request->file('image')){
			$fileName = time().$request->file('image')->getClientOriginalName();
			$this->uploadImage('referer',$fileName,$request->file('image'),$oldFileName);
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

		$refererUpdate = $userDetail->referer()->first();
		$refererUpdate->fill([
			'status'=>$status,
			'updated_by'=>$request->user()->id,
			'qualification'=>$request->get('qualification'),
			'profession'=>$request->get('profession'),
			'relation'=>$request->get('relation'),
			'description'=>$request->get('description')
		])->save();

		$this->session->flash('update_success_info','" referer named '.$request->get('name').'"');
		return redirect()->route('referer.index');
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
		$this->session->flash('delete_success_info','" referer named '.$userName.'"');
		return redirect()->route('referer.index');
	}

}
