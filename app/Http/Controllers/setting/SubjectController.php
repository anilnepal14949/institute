<?php namespace ProIMAN\Http\Controllers\setting;

use ProIMAN\Http\Requests;
use ProIMAN\Http\Controllers\Controller;
use ProIMAN\CourseType;
use ProIMAN\Subject;
use ProIMAN\Http\Requests\setting\CreateSubjectRequest;
use Illuminate\Session\Store as Session;

class SubjectController extends Controller {
	/**
	 * @var array
	 */
	protected $pro_data;
	protected $session;
	protected $courseType;
	protected $subject;
	/**
	 * Constructor.
	 *
	 * @param CourseType $courseType				The CourseType Model
	 * @param Session $session						The Session Class
	 * @param Subject $subject   					The Student Model
	 * @api
	 */
	public function __construct(Session $session, CourseType $courseType, Subject $subject)
	{

		$this->courseType = $courseType;
		$this->session = $session;
		$this->subject = $subject;

		$this->middleware('course.type');
		$this->middleware('course.type.level');

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
		//$subjects = $this->subject->all();
		$subjects = $this->subject->with('courseTypeLevel.courseType')->orderBy('course_type_level_id','desc')->orderBy('id','desc')->get();
		$this->pro_data['subjects'] = ($subjects->isEmpty())?'':$subjects;
		$this->pro_data['courseTypes'] = $this->courseType->whereStatus('0')->get();
		return view('setting.subject.index',$this->pro_data);
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
	 * @param CreateSubjectRequest $request
	 * @return Response
	 */
	public function store(CreateSubjectRequest $request)
	{
		($request->get('status') == "on")?$status=0:$status=1;
		$this->subject->create([
			'name'=>$request->get('name'),
			'course_type_level_id'=>$request->get('course_type_level_id'),
			'description'=>$request->get('description'),
			'created_by'=>$request->user()->id,
			'updated_by'=>$request->user()->id,
			'status'=>$status
		]);

		$this->session->flash('store_success_info','" subject named '.$request->get('name').'"');
		return redirect()->route('subject.index');
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
	 * @param Subject $subject
	 * @return Response
	 */
	public function edit(Subject $subject)
	{
		$this->pro_data['subjects'] = $this->subject->orderBy('course_type_level_id','desc')->orderBy('id','desc')->get();

		$courseTypes = $this->courseType->whereStatus('0');
		$this->pro_data['subject']  = $subject;
		$this->pro_data['courseTypes'] = $courseTypes->get();

		return view('setting.subject.edit',$this->pro_data);
	}

	/**
	 * Update the specified resource in storage.
	 * @param  CreateSubjectRequest $request
	 * @param  Subject $subject
	 * @return Response
	 */
	public function update(CreateSubjectRequest $request, Subject $subject)
	{
		($request->get('status') == "on")?$status=0:$status=1;

		$subject->fill([
			'name'=>$request->get('name'),
			'course_type_level_id'=>$request->get('course_type_level_id'),
			'description'=>$request->get('description'),
			'updated_by'=>$request->user()->id,
			'status'=>$status
		])->save();

		$this->session->flash('update_success_info','" subject named '.$request->get('name').'"');
		return redirect()->route('subject.index');
	}

	/**
	 * Remove the specified resource from storage.
	 * @param  Subject $subject
	 * @return Response
	 */
	public function destroy(Subject $subject)
	{
		$subjectName = $subject->getAttribute('name');
		$subject->delete();
		$this->session->flash('delete_success_info','" subject named '.$subjectName.'"');
		return redirect()->route('subject.index');
	}

}
