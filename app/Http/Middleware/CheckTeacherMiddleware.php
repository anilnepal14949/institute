<?php namespace ProIMAN\Http\Middleware;

use Closure;
use ProIMAN\Teacher;

class CheckTeacherMiddleware {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		if(Teacher::whereStatus('0')->get()->isEmpty()){
			return redirect()->route('teacher.index')->with('redirect_to','" teacher"');
		}
		return $next($request);
	}

}
