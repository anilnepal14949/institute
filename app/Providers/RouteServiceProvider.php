<?php namespace ProIMAN\Providers;

use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider {

	/**
	 * This namespace is applied to the controller routes in your routes file.
	 *
	 * In addition, it is set as the URL generator's root namespace.
	 *
	 * @var string
	 */
	protected $namespace = 'ProIMAN\Http\Controllers';

	/**
	 * Define your route model bindings, pattern filters, etc.
	 *
	 * @param  \Illuminate\Routing\Router  $router
	 * @return void
	 */
	public function boot(Router $router)
	{
		parent::boot($router);

		/* Room Model Binding */
		$router->model('room','ProIMAN\Room');

		/* UserDetail Model Binding (for student)*/
		$router->model('student','ProIMAN\UserDetail');

		/* UserDetail Model Binding (for teacher)*/
		$router->model('teacher','ProIMAN\UserDetail');

		/* UserDetail Model Binding (for referer)*/
		$router->model('referer','ProIMAN\UserDetail');

		/* CourseType Model Binding */
		$router->model('course_type','ProIMAN\CourseType');

		/* CourseTypeLevel Model Binding */
		$router->model('course_type_level','ProIMAN\CourseTypeLevel');

		/* Subject Model Binding */
		$router->model('subject','ProIMAN\Subject');

		/* OurCourse Model Binding */
		$router->model('our_course','ProIMAN\OurCourse');

		/* Inquiry Model Binding */
		$router->model('inquiry_subject','ProIMAN\Inquiry');

	}

	/**
	 * Define the routes for the application.
	 *
	 * @param  \Illuminate\Routing\Router  $router
	 * @return void
	 */
	public function map(Router $router)
	{
		$router->group(['namespace' => $this->namespace], function($router)
		{
			require app_path('Http/routes.php');
		});
	}

}
