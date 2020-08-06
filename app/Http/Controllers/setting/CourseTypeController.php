<?php namespace ProIMAN\Http\Controllers\setting;

use ProIMAN\Http\Requests;
use ProIMAN\Http\Controllers\Controller;
use ProIMAN\CourseType;
use ProIMAN\Http\Requests\setting\CreateCourseTypeRequest;
use Illuminate\Session\Store as Session;

class CourseTypeController extends Controller {
	/**
	 * @var array
	 */
	protected $pro_data;
	protected $courseType;
	protected $session;

	/**
	 * Constructor.
	 *
	 * @param Session $session				The Session Class
	 * @param CourseType $courseType   		The CourseType Model
	 *
	 * @api
	 */
	public function __construct(Session $session, CourseType $courseType)
	{

		$this->courseType = $courseType;
		$this->session = $session;
		//$session->clear();

		// set session for pop up message.
		$session->has('store_success_info')?$this->pro_data['store_success_info'] = $session->pull('store_success_info'):'';
		$session->has('update_success_info')?$this->pro_data['update_success_info'] = $session->pull('update_success_info'):'';
		$session->has('delete_success_info')?$this->pro_data['delete_success_info'] = $session->pull('delete_success_info'):'';
		$session->has('redirect_to')?$this->pro_data['redirect_to'] = $session->pull('redirect_to'):'';
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$courseTypes = $this->courseType->orderBy('id','desc')->orderBy('updated_at','desc')->get();
		$this->pro_data['courseTypes'] = ($courseTypes->isEmpty())?'':$courseTypes;
		return view('setting.course-type.index',$this->pro_data);
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
	 * @param CreateCourseTypeRequest $request
	 * @return Response
	 */
	public function store(CreateCourseTypeRequest $request)
	{
		($request->get('status') == "on")?$status=0:$status=1;

		$this->courseType->create([
			'name'=>$request->get('name'),
			'description'=>$request->get('description'),
			'created_by'=>$request->user()->id,
			'updated_by'=>$request->user()->id,
			'status'=>$status
		]);

		$this->session->flash('store_success_info','" course type named '.$request->get('name').'"');
		return redirect()->route('course-type.index');
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
	 * @param CourseType $courseType
	 * @return Response
	 */
	public function edit(CourseType $courseType)
	{
		$this->pro_data['courseTypes'] = $courseType->orderBy('id','desc')->orderBy('updated_at','desc')->get();

		$this->pro_data['courseType']  = $courseType;

		return view('setting.course-type.edit',$this->pro_data);
	}

	/**
	 * Update the specified resource in storage.
	 * @param  CreateCourseTypeRequest $request
	 * @param CourseType $courseType
	 * @return Response
	 */
	public function update(CreateCourseTypeRequest $request, CourseType $courseType)
	{
		($request->get('status') == "on")?$status=0:$status=1;

		$courseType->fill([
			'name'=>$request->get('name'),
			'description'=>$request->get('description'),
			'updated_by'=>$request->user()->id,
			'status'=>$status
		])->save();

		$this->session->flash('update_success_info','" course type named '.$request->get('name').'"');
		return redirect()->route('course-type.index');
	}

	/**
	 * Remove the specified resource from storage.
	 * @param CourseType $courseType
	 * @return Response
	 */
	public function destroy(CourseType $courseType)
	{
		$courseTypeName = $courseType->getAttribute('name');
		$courseType->delete();
		$this->session->flash('delete_success_info','" course type named '.$courseTypeName.'"');
		return redirect()->route('course-type.index');
	}

}
