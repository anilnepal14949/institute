<?php namespace ProIMAN\Http\Middleware;

use Closure;
use ProIMAN\Subject;

class CheckSubjectMiddleware {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		if(Subject::whereStatus('0')->get()->isEmpty()){
			return redirect()->route('subject.index')->with('redirect_to','" subject"');
		}
		return $next($request);
	}

}
