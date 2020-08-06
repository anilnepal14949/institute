<?php namespace ProIMAN\Http\Controllers\report;

use ProIMAN\Http\Requests;
use ProIMAN\Http\Controllers\Controller;
use ProIMAN\OurCourse;
use ProIMAN\UserDetail;
use Illuminate\Http\Request;

class ReportAjaxController extends Controller {

	/**
	 *
     */
	public function __construct()
	{

	}

	/**
	 * @param Request $request
	 * @param OurCourse $ourCourse
	 * @return bool|string
     */
	public function feedOurCourses(Request $request, OurCourse $ourCourse){
		if($request->ajax()){
			$input = $request->get('input');
			$ourCourseInfo = $ourCourse->with('teacher.userDetail','room','status','subject.courseTypeLevel')->search($input)->whereStatus('0')->orderBy('status_id')->get();
			$return = '';
			if($ourCourseInfo->isEmpty()){
				$return .= '<div class="pro_search_not_found">Sorry, Course Not Found :( !! Please Try Again!!</div>';
			}else{
				$return .='<table class="table"><tr><th width="5%">S.N.</th><th>Name</th><th width="15%">Room</th><th width="15%">Teacher</th><th width="15%">Time</th><th width="15%">Duration</th><th width="10%">Status</th></tr>';
				$i=1;
				foreach($ourCourseInfo as $course){
					$return .= '<tr';
					if($course->status_id == 2)
						$return .= ' class="warning"';
					else if($course->status_id == 3)
						$return .= ' class="success"';
					else if($course->status_id == 4)
						$return .= ' class="danger"';

					$return .= '>';
					$return .= '<td>'.$i++.'.</td>';
					$return .= '<td>';
					$return .= $course->name.'<br /><small><label class="label label-info">'.$course->subject->courseTypeLevel->name.'</label> <label class="label label-warning"> '.$course->subject->name.'</label></small>';
					$return .= '</td>';
					$return .= '<td>'.$course->room->name.'</td>';
					$return .= '<td>'.$course->teacher->userDetail->name.'</td>';
					$return .= '<td>'.date('g:ia',strtotime($course->start_time)).' to <br />'.date('g:ia',strtotime($course->end_time)).'</td>';
					$return .= '<td>'.date('jS F Y',strtotime($course->start_date)).' to <br />'.date('jS F Y',strtotime($course->end_date)).'</td>';
					$return .= '<td>';
					$return .= ($course->status==0)?'<label class="label label-success">Active</label>':'<label class="label label-danger">Inactive</label>';
					$return .= '</td></tr>';
				}
				$return .= '</table>';
			}
			return $return;
		}
		return false;

	}

	/**
	 * @param Request $request
	 * @param UserDetail $userDetail
	 * @return bool|string
     */
	public function feedUsers(Request $request, UserDetail $userDetail){

		if($request->ajax()){
			$input = $request->get('input');
			$selector = $request->get('selector');
			if($selector == 2){
				$userDetailInfo = $userDetail->search($input)->whereUser_type(2)->whereStatus('0')->get();
			}else{
				$userDetailInfo = $userDetail->search($input)->whereStatus('0')->get();
			}
			$return = '';
			if($userDetailInfo->isEmpty()){
				$return .= '<div class="pro_search_not_found">Sorry, Teacher Not Found :( !! Please Try Again!!</div>';
			}else{
				$return .='<table class="table"><tr><th width="5%">S.N.</th><th>Name</th><th width="15%">Address</th><th width="15%">Contact</th><th width="15%">Email</th><th width="15%">Date of Birth</th><th width="10%">Status</th></tr>';
				$i=1;
				foreach($userDetailInfo as $user){
					$return .= '<tr><td>'.$i++.'.</td>';
					$return .= '<td>'.$user->name.'</td>';
					$return .= '<td>'.$user->address.'</td>';
					$return .= '<td>'.$user->contact.'</td>';
					$return .= '<td>'.$user->email.'</td>';
					$return .= '<td>'.$user->dob.'</td>';
					$return .= '<td>';
					$return .= ($user->status==0)?'<label class="label label-success">Active</label>':'<label class="label label-danger">Inactive</label>';
					$return .= '</td></tr>';
				}
				$return .= '</table>';
			}
			return $return;
		}
		return false;
	}
}
