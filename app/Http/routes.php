<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['middleware' => 'auth'],function(){

	get('/', ['as'=>'home','uses'=>'dashboard\DashboardController@index']);
	get('/courses', ['as'=>'courses','uses'=>'HomeController@courses']);
	get('/enroll', ['as'=>'enroll','uses'=>'HomeController@enroll']);

	/*
	 * delete file
	 * */
	post('/delete-pro-file', ['as'=>'delete.file','uses'=>'HomeController@delete_file']);

	/*
	 * setting starts
	 */
	Route::group(['prefix'=>'setting'],function(){
		/*setting first page*/
		get('/', ['as'=>'setting','uses'=>'setting\SettingController@index']);

		/*setting room*/
		resource('room','setting\RoomController',
			['names'=>[
				'index'=>'room.index'
			]]);

		/*setting student*/
		resource('student','setting\StudentController',
			['names'=>[
				'index'=>'student.index'
			]]);

		/*setting teacher*/
		resource('teacher','setting\TeacherController',
			['names'=>[
				'index'=>'teacher.index'
			]]);

		/*setting course type*/
		resource('course-type','setting\CourseTypeController',
			['names'=>[
				'index'=>'course-type.index'
			]]);

		/*setting course type level*/
		resource('course-type-level','setting\CourseTypeLevelController',
			['names'=>[
				'index'=>'course-type-level.index'
			]]);

		/*setting subject*/
		resource('subject','setting\SubjectController',
			['names'=>[
				'index'=>'subject.index'
			]]);

		/*setting our-course*/
		resource('our-course','setting\OurCourseController',
			['names'=>[
				'index'=>'our-course.index'
			]]);

		/*setting referer*/
		resource('referer','setting\RefererController',
			['names'=>[
				'index'=>'referer.index'
			]]);

	});

	/*
	* Ajax request for Setting / Enroll
	*/
	get('/ajax-request/setting/show-course-type-level',['uses'=>'setting\AjaxController@feedCourseTypeLevel']);
	get('/ajax-request/setting/show-subject',['uses'=>'setting\AjaxController@feedSubject']);
	/*
	 * setting ends
	 */


	/*
	 * Enroll starts
	 */
	Route::group(['prefix'=>'enroll'],function(){
		/*enroll first page*/
		get('/', ['as'=>'enroll','uses'=>'enroll\EnrollStudentController@index']);

		/*enroll student*/
		resource('enroll-student','enroll\EnrollStudentController',
			['names'=>[
				'index'=>'enroll.student.index'
			]]);

		/*enroll student-bill*/
		resource('enroll-student-bill','enroll\EnrollStudentBillController',
			['names'=>[
				'index'=>'enroll.student-bill.index'
			]]);
	});

	/*
	* Ajax request for Enroll
	*/
	/*
	 * Enroll ends
	 */


	 /*
	 * Dashboard starts
	 */
	Route::group(['prefix'=>'dashboard'],function(){
		/*dashboard first page*/
		get('/', ['as'=>'dashboard','uses'=>'dashboard\DashboardController@index']);

	});

/*
* Ajax request for Dashboard
 *
*/
get('/ajax-request/dashboard/users',['uses'=>'dashboard\DashboardAjaxController@feedUsers']);
/*
 * Dashboard ends
 */


/*
 * inquiry starts
 */
Route::group(['prefix'=>'inquiry'],function(){
	/*inquiry first page*/
	get('/', ['as'=>'inquiry','uses'=>'inquiry\InquiryController@index']);

	/*inquiry student-bill*/
	resource('inquiry-subject','inquiry\InquirySubjectController',
		['names'=>[
			'index'=>'inquiry.subject.index'
		]]);
});

/*
* Ajax request for inquiry
*/
get('/ajax-request/inquiry/inquiry-subject',['uses'=>'inquiry\InquiryAjaxController@feedInquiries']);
/*
 * inquiry ends
 */

/*
 * report starts
 */
Route::group(['prefix'=>'report'],function(){
	/*report first page*/
	get('/', ['as'=>'report','uses'=>'report\ReportController@index']);

	/*report receipt*/
	resource('report-receipt','report\ReportReceiptController',
		['names'=>[
			'index'=>'report.receipt.index'
		]]);

	/*report our course*/
	resource('report-our-course','report\ReportOurCourseController',
		['names'=>[
			'index'=>'report.our-course.index'
		]]);

	/*report teacher*/
	resource('report-teacher','report\ReportTeacherController',
		['names'=>[
			'index'=>'report.teacher.index'
		]]);
});

/*
* Ajax request for report
*/
	get('/ajax-request/report/our-courses',['uses'=>'report\ReportAjaxController@feedOurCourses']);
	get('/ajax-request/report/users',['uses'=>'report\ReportAjaxController@feedUsers']);
/*
 * report ends
 */

});


Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

/*Event::listen('illuminate.query', function($query, $params, $time, $conn)
{
	print_r(array($query, $params, $time, $conn));
});*/
