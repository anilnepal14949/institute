/*==========================================
 * 
 /*========================================
 * Setting -> Subject
 */
$(document).ready(function() {
	
    /*==========================================
     * SHOW COURSE TYPE LEVEL AJAX VARIABLES
     *==========================================*/
    var $ct_id = $('#course_type_id');
    var $ctl_id = $('#course_type_level_id');

    $ct_id.change(function(){
        var $val = $(this).val();
        showCourseTypeLevel($val);
    });


    $ctl_id.change(function(){
        var $val = $(this).val();
        showSubject($val);
    });
});
/*==========================================
 * SHOW COURSE TYPE LEVEL AJAX FUNCTION
 *==========================================*/
function showCourseTypeLevel($course_type_id, $default_id){
	var $url = $('#homePath').val()+'/ajax-request/setting/show-course-type-level';
	var $target = $('#ajaxSelectbox');
    $target.html('<br /><span class="glyphicon glyphicon-cog faa-spin animated"></span>');
    $.ajax({
        url: $url,
        dataType: 'html',
        data: 'course_type_id='+$course_type_id+'&default_id='+$default_id,
        type: 'GET',
        cache: false,
        success: function(rval){
            $target.html(rval);
        }
    });
}

/*==========================================
 * SHOW SUBJECT AJAX FUNCTION
 *==========================================*/
function showSubject($subject_id, $default_id){
    var $url = $('#homePath').val()+'/ajax-request/setting/show-subject';
    var $target = $('#ajaxSelectbox');
    $target.html('<br /><span class="glyphicon glyphicon-cog faa-spin animated"></span>');
    $.ajax({
        url: $url,
        dataType: 'html',
        data: 'course_type_level_id='+$subject_id+'&default_id='+$default_id,
        type: 'GET',
        cache: false,
        success: function(rval){
            $target.html(rval);
        }
    });
}