<?php namespace ProIMAN\Http\Middleware;

use Closure;
use ProIMAN\CourseType;

class CheckCourseTypeMiddleware {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		if(CourseType::whereStatus('0')->get()->isEmpty()){
			return redirect()->route('course-type.index')->with('redirect_to','" course type"');
		}
		return $next($request);
	}

}
