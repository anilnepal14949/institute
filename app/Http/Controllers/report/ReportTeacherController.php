<?php namespace ProIMAN\Http\Controllers\report;

use Illuminate\Support\Facades\DB;
use ProIMAN\Http\Requests;
use ProIMAN\Http\Controllers\Controller;

use ProIMAN\Teacher;

class ReportTeacherController extends Controller {


	protected $teacher;
	protected $pro_data;
	/**
	 * @param Teacher $teacher
     */
	public function __construct(Teacher $teacher){
		$this->teacher = $teacher;
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$this->pro_data['teachers'] = $this->teacher->with('userDetail')->get();
		return view('report.report-teacher.index',$this->pro_data);
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

}
