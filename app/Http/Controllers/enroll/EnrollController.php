<?php namespace ProIMAN\Http\Controllers\enroll;

use ProIMAN\Http\Requests;
use ProIMAN\Referer;
use ProIMAN\OurCourse;
use ProIMAN\Student;
use ProIMAN\StudentEnroll;
use ProIMAN\Http\Controllers\Controller;

use Illuminate\Http\Request;

class EnrollController extends Controller {

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

		$this->pro_data['enrollStudents'] = StudentEnroll::whereStatus('0')->orderBy('id','desc')->get();

		$this->pro_data['ourCourses'] = OurCourse::whereStatus('0')->orderBy('id','desc')->get();
		$this->pro_data['students'] = Student::with('userDetail')->whereStatus('0')->orderBy('id','desc')->get();
		$this->pro_data['referers'] = Referer::with('userDetail')->whereStatus('0')->orderBy('id','desc')->get();
		return view('enroll.student.index',$this->pro_data);
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
	{//

	}

}
