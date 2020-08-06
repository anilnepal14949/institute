<?php namespace ProIMAN\Http\Controllers\dashboard;

use Illuminate\Support\Facades\DB;
use ProIMAN\Http\Requests;
use ProIMAN\Http\Controllers\Controller;

use Illuminate\Http\Request;
use ProIMAN\Inquiry;
use ProIMAN\OurCourse;
use ProIMAN\Room;
use ProIMAN\StudentEnroll;

class DashboardController extends Controller {

	protected $pro_data;
	public function __construct()
	{

	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$studentEnroll = StudentEnroll::whereStatus(0);
		$inquiry = Inquiry::whereStatus(0);
		$this->pro_data['ourCourses'] = OurCourse::whereStatus(0)->with('subject.courseTypeLevel','room','teacher.userDetail','status')->orderBy('status_id')->get();
		$this->pro_data['totalEnrolled'] = $studentEnroll->get()->count();
		$this->pro_data['enrolledToday'] = $studentEnroll->where('enroll_date',date('Y-m-d'))->get()->count();
		$this->pro_data['totalInquiries'] = $inquiry->get()->count();
		$this->pro_data['inquiriesToday'] = $inquiry->whereRaw('MID(created_at,1,10) = "'.date("Y-m-d").'"')->get()->count();

		$runningCourses = OurCourse::whereRaw('start_time <= "'.date('G:i:s').'" and end_time >= "'.date('G:i:s').'" and end_date >= "'.date('Y-m-d').'"');
		$notRunningCourses = OurCourse::whereRaw('start_time > "'.date('G:i:s').'" and end_time < "'.date('G:i:s').'" and end_date >= "'.date('Y-m-d').'"');
		$this->pro_data['upcomingCourses'] = $runningCourses->with('teacher.userDetail','room','studentEnroll')->orderBy('start_time','desc')->get();

		$this->pro_data['freeRooms'] = $notRunningCourses->with('room')->get()->count();
		return view('dashboard.home',$this->pro_data);
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
	 *
	 * @return Response
	 */
	public function store()
	{
		//
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
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
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
				'pro_room.number as room_no',
				'pro_status.name as status_name',
				'pro_subjects.name as subject_name',
				'pro_teachers.user_id as teacher_user_id',
				'pro_our_courses.*'
			])
			->whereNull('pro_our_courses.deleted_at')
			->get();
	}
}
