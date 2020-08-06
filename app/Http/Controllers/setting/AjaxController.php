<?php namespace ProIMAN\Http\Controllers\setting;

use Illuminate\Http\Request;
use PhpSpec\Wrapper\Subject;
use ProIMAN\Http\Controllers\Controller;

use ProIMAN\CourseTypeLevel;
use ProIMAN\Subject as Subject1;

class AjaxController extends Controller {

    /**
     * Show Course Type Level using course type id.
     * @param Request $request
     * @param CourseTypeLevel $courseTypeLevel
     * @return bool|string
     */
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


    /**
     * Show Subjects using course type level id.
     * @param Request $request
     * @param Subject1 $subject
     * @return bool|string
     */
    public function feedSubject(Request $request, Subject1 $subject){

        if($request->ajax()){

            $course_type_level_id = $request->get('course_type_level_id');
            $subjects = $subject->whereStatus('0')->whereCourse_type_id($course_type_level_id)->get();

            $return = '<select class="form-control" name="course_type_level_id" id="course_type_level_id">';
            foreach( $subjects as $sub){
                $return .= '<option value="'.$sub->id.'"';
                if($request->get('default_id')>0){
                    if($request->get('default_id') == $sub->id){
                        $return .= ' selected="selected"';
                    }
                }
                $return .='>'.$sub->name.'</option>';
            }
            $return .= '</select>';

            return $return;
        }
        return false;
    }
}
