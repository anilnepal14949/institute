<?php namespace ProIMAN\Http\Controllers\report;

use Illuminate\Support\Facades\DB;
use ProIMAN\Http\Requests;
use ProIMAN\Http\Controllers\Controller;

use ProIMAN\OurCourse;

class ReportOurCourseController extends Controller {


	protected $ourCourse;
	protected $pro_data;
	/**
	 * @param OurCourse $ourCourse
     */
	public function __construct(OurCourse $ourCourse){
		$this->ourCourse = $ourCourse;
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('report.report-our-course.index');
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
	/*public function getAllData(){
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
	}*/

}
