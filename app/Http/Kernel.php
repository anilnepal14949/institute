<?php namespace ProIMAN\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel {

	/**
	 * The application's global HTTP middleware stack.
	 *
	 * @var array
	 */
	protected $middleware = [
		'Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode',
		'Illuminate\Cookie\Middleware\EncryptCookies',
		'Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse',
		'Illuminate\Session\Middleware\StartSession',
		'Illuminate\View\Middleware\ShareErrorsFromSession',
		'ProIMAN\Http\Middleware\VerifyCsrfToken'
	];

	/**
	 * The application's route middleware.
	 *
	 * @var array
	 */
	protected $routeMiddleware = [
		'auth' => 'ProIMAN\Http\Middleware\Authenticate',
		'auth.basic' => 'Illuminate\Auth\Middleware\AuthenticateWithBasicAuth',
		'guest' => 'ProIMAN\Http\Middleware\RedirectIfAuthenticated',
		'course.type' => 'ProIMAN\Http\Middleware\CheckCourseTypeMiddleware',
		'course.type.level' => 'ProIMAN\Http\Middleware\CheckCourseTypeLevelMiddleware',
		'subject' => 'ProIMAN\Http\Middleware\CheckSubjectMiddleware',
		'room' => 'ProIMAN\Http\Middleware\CheckRoomMiddleware',
		'teacher' => 'ProIMAN\Http\Middleware\CheckTeacherMiddleware'
	];

}
