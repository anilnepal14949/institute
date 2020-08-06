<?php namespace ProIMAN\Http\Controllers\setting;

use ProIMAN\Http\Requests;
use ProIMAN\Http\Controllers\Controller;
use ProIMAN\CourseTypeLevel;
use ProIMAN\CourseType;
use ProIMAN\Http\Requests\setting\CreateCourseTypeLevelRequest;
use Illuminate\Session\Store as Session;

class CourseTypeLevelController extends Controller {
	/**
	 * @var array
	 */
	protected $pro_data;
	protected $courseTypeLevel;
	protected $session;
	/**
	 * Constructor.
	 *
	 * @param Session $session						The Session Class
	 * @param CourseTypeLevel $courseTypeLevel   	The CourseTypeLevel Model
	 *
	 * @api
	 */
	public function __construct(Session $session, CourseTypeLevel $courseTypeLevel)
	{

		$this->courseTypeLevel = $courseTypeLevel;
		$this->session = $session;

		$this->middleware('course.type');

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
		$courseTypeLevels = $this->courseTypeLevel->with('courseType')->orderBy('course_type_id','desc')->orderBy('id','desc')->orderBy('updated_at','desc')->get();
		$this->pro_data['courseTypeLevels'] = ($courseTypeLevels->isEmpty())?'':$courseTypeLevels;
		$this->pro_data['courseTypes'] = CourseType::whereStatus('0')->get();
		return view('setting.course-type-level.index',$this->pro_data);
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
	 * @param CreateCourseTypeLevelRequest $request
	 * @return Response
	 */
	public function store(CreateCourseTypeLevelRequest $request)
	{
		($request->get('status') == "on")?$status=0:$status=1;

		$this->courseTypeLevel->create([
			'name'=>$request->get('name'),
			'course_type_id'=>$request->get('course_type_id'),
			'description'=>$request->get('description'),
			'created_by'=>$request->user()->id,
			'updated_by'=>$request->user()->id,
			'status'=>$status
		]);

		$this->session->flash('store_success_info','" course type level named '.$request->get('name').'"');
		return redirect()->route('course-type-level.index');
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
	 * @param CourseTypeLevel $courseTypeLevel
	 * @return Response
	 */
	public function edit(CourseTypeLevel $courseTypeLevel)
	{
		$this->pro_data['courseTypeLevels'] = $courseTypeLevel->all();
		$this->pro_data['courseTypeLevel']  = $courseTypeLevel;
		$this->pro_data['courseTypes'] = CourseType::whereStatus('0')->get();

		return view('setting.course-type-level.edit',$this->pro_data);
	}

	/**
	 * Update the specified resource in storage.
	 * @param  CreateCourseTypeLevelRequest $request
	 * @param CourseTypeLevel $courseTypeLevel
	 * @return Response
	 */
	public function update(CreateCourseTypeLevelRequest $request, CourseTypeLevel $courseTypeLevel)
	{
		($request->get('status') == "on")?$status=0:$status=1;

		$courseTypeLevel->fill([
			'name'=>$request->get('name'),
			'course_type_id'=>$request->get('course_type_id'),
			'description'=>$request->get('description'),
			'updated_by'=>$request->user()->id,
			'status'=>$status
		])->save();

		$this->session->flash('update_success_info','" course type level named '.$request->get('name').'"');
		return redirect()->route('course-type-level.index');
	}

	/**
	 * Remove the specified resource from storage.
	 * @param CourseTypeLevel $courseTypeLevel
	 * @return Response
	 */
	public function destroy(CourseTypeLevel $courseTypeLevel)
	{
		$courseTypeLevelName = $courseTypeLevel->getAttribute('name');
		$courseTypeLevel->delete();
		$this->session->flash('delete_success_info','" course type level named '.$courseTypeLevelName.'"');
		return redirect()->route('course-type-level.index');
	}

}
