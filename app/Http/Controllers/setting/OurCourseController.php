<?php namespace ProIMAN\Http\Controllers\setting;

use Illuminate\Support\Facades\DB;
use ProIMAN\Http\Requests;
use ProIMAN\Http\Controllers\Controller;
use ProIMAN\Subject;
use ProIMAN\OurCourse;
use ProIMAN\Teacher;
use ProIMAN\Room;
use ProIMAN\Status;
use ProIMAN\Http\Requests\setting\CreateOurCourseRequest;
use Illuminate\Session\Store as Session;

class OurCourseController extends Controller {
	/**
	 * @var array
	 */
	protected $pro_data;
	protected $session;
	protected $ourCourse;
	protected $subject;
	protected $teacher;
	protected $status;
	protected $room;
	/**
	 * Constructor.
	 *
	 * @param OurCourse	$ourCourse					The OurCourse Model
	 * @param Session $session						The Session Class
	 * @param Subject $subject   					The Student Model
	 * @param Teacher $teacher						The Teacher Model
	 * @param Room $room							The Room Model
	 * @param Status $status						The Status Model
	 * @api
	 */
	public function __construct(Session $session, Subject $subject, OurCourse $ourCourse, Teacher $teacher, Room $room, Status $status)
	{
		$this->ourCourse = $ourCourse;
		$this->session = $session;
		$this->subject = $subject;
		$this->teacher = $teacher;
		$this->room = $room;
		$this->status = $status;

		$this->middleware('subject');
		$this->middleware('room');
		$this->middleware('teacher');

		// set session for pop up message.
		$session->has('store_success_info')?$this->pro_data['store_success_info'] = $session->pull('store_success_info'):'';
		$session->has('update_success_info')?$this->pro_data['update_success_info'] = $session->pull('update_success_info'):'';
		$session->has('delete_success_info')?$this->pro_data['delete_success_info'] = $session->pull('delete_success_info'):'';
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$ourCourses = $this->getAllData();
		$this->pro_data['ourCourses'] = (empty($ourCourses))?'':$ourCourses;
		$this->setDataForForm();
		return view('setting.our-course.index',$this->pro_data);
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
	 * @param CreateOurCourseRequest $request
	 * @return Response
	 */
	public function store(CreateOurCourseRequest $request)
	{
		($request->get('status') == "on")?$status=0:$status=1;
		$this->ourCourse->create([
			'name'=>$request->get('name'),
			'room_id'=>$request->get('room_id'),
			'subject_id'=>$request->get('subject_id'),
			'status_id'=>$request->get('status_id'),
			'teacher_id'=>$request->get('teacher_id'),
			'start_date'=>$request->get('start_date'),
			'end_date'=>$request->get('end_date'),
			'start_time'=>$request->get('start_time'),
			'end_time'=>$request->get('end_time'),
			'capacity'=>$request->get('capacity'),
			'course_fee'=>$request->get('course_fee'),
			'form_fee'=>$request->get('form_fee'),
			'description'=>$request->get('description'),

			'created_by'=>$request->user()->id,
			'updated_by'=>$request->user()->id,
			'status'=>$status
		]);
		$this->session->flash('store_success_info','" our course with subject named '.$request->get('name').'"');
		return redirect()->route('our-course.index');
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
	 * @param  OurCourse $ourCourse
	 * @return Response
	 */
	public function edit(OurCourse $ourCourse)
	{
		$ourCourses= $this->getAllData();
		$this->pro_data['ourCourses'] = (empty($ourCourses))?'':$ourCourses;
		$this->pro_data['ourCourse'] = $ourCourse;
		$this->setDataForForm();
		return view('setting.our-course.edit',$this->pro_data);
	}

	/**
	 * Update the specified resource in storage.
	 * @param  CreateOurCourseRequest $request
	 * @param  OurCourse $ourCourse
	 * @return Response
	 */
	public function update(CreateOurCourseRequest $request, OurCourse $ourCourse)
	{
		($request->get('status') == "on")?$status=0:$status=1;

		$ourCourse->fill([
			'name'=>$request->get('name'),
			'room_id'=>$request->get('room_id'),
			'subject_id'=>$request->get('subject_id'),
			'status_id'=>$request->get('status_id'),
			'teacher_id'=>$request->get('teacher_id'),
			'start_date'=>$request->get('start_date'),
			'end_date'=>$request->get('end_date'),
			'start_time'=>$request->get('start_time'),
			'end_time'=>$request->get('end_time'),
			'capacity'=>$request->get('capacity'),
			'course_fee'=>$request->get('course_fee'),
			'form_fee'=>$request->get('form_fee'),
			'description'=>$request->get('description'),

			'created_by'=>$request->user()->id,
			'updated_by'=>$request->user()->id,
			'status'=>$status
		])->save();

		$this->session->flash('update_success_info','" our course named '.$request->get('name').'"');
		return redirect()->route('our-course.index');
	}

	/**
	 * Remove the specified resource from storage.
	 * @param	OurCourse $ourCourse
	 * @return Response
	 */
	public function destroy(OurCourse $ourCourse)
	{
		$ourCourseName = $ourCourse->getAttribute('name');
		$ourCourse->delete();
		$this->session->flash('delete_success_info','" our course named '.$ourCourseName.'"');
		return redirect()->route('our-course.index');
	}

	/**
	 * Give all data using join.
	 * @return mixed
     */
	public function getAllData(){
		return DB::table('pro_our_courses')
			->leftJoin('pro_room', function($join)
			{
				$join->on('pro_our_courses.room_id', '=', 'pro_room.id');
			})
			->leftJoin('pro_status', function($join)
			{
				$join->on('pro_our_courses.status_id', '=', 'pro_status.id');
			})
			->leftJoin('pro_subjects', function($join)
			{
				$join->on('pro_our_courses.subject_id', '=', 'pro_subjects.id');
			})
			->leftJoin('pro_teachers', function($join)
			{
				$join->on('pro_our_courses.teacher_id', '=', 'pro_teachers.id');
			})
			->select([
				'pro_room.name as room_name',
				'pro_status.name as status_name',
				'pro_subjects.name as subject_name',
				'pro_teachers.user_id as teacher_user_id',
				'pro_our_courses.*'
			])
			->whereNull('pro_our_courses.deleted_at')
            ->orderBy('subject_id','desc')
            ->orderBy('id','desc')
			->get();
	}

	/**
	 * set data for form.
     */
	function setDataForForm(){
		$this->pro_data['subjects'] = $this->subject->whereStatus('0')->with('courseTypeLevel.courseType')->orderBy('course_type_level_id','desc')->get();
		$this->pro_data['teachers'] = $this->teacher->with('userDetail')->whereStatus('0')->get();
		$this->pro_data['statuses'] = $this->status->whereStatus('0')->get();
		$this->pro_data['rooms'] = $this->room->whereStatus('0')->get();
	}
}
