<?php namespace ProIMAN\Http\Middleware;

use Closure;
use ProIMAN\CourseTypeLevel;

class CheckCourseTypeLevelMiddleware {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		if(CourseTypeLevel::whereStatus('0')->get()->isEmpty()){
			return redirect()->route('course-type-level.index')->with('redirect_to','" course type level"');
		}
		return $next($request);
	}

}
