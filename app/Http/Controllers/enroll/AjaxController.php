<?php namespace ProIMAN\Http\Controllers\enroll;

use Illuminate\Http\Request;
use ProIMAN\Http\Controllers\Controller;

use ProIMAN\CourseTypeLevel;

class AjaxController extends Controller {

	public function feedCourseTypeLevel(Request $request, CourseTypeLevel $courseTypeLevel){

        if($request->ajax()){

            $course_type_id = $request->get('course_type_id');
            $courseTypeLevels = $courseTypeLevel->whereStatus('0')->whereCourse_type_id($course_type_id)->get();

            $return = '<select class="form-control" name="course_type_level_id" id="course_type_level_id">';
            foreach( $courseTypeLevels as $ctLevel ){
                $return .= '<option value="'.$ctLevel->id.'"';
                if($request->get('default_id')>0){
                    if($request->get('default_id') == $ctLevel->id){
                        $return .= ' selected="selected"';
                    }
                }
                $return .='>'.$ctLevel->name.'</option>';
            }
            $return .= '</select>';

            return $return;
        }
        return false;
    }

}
