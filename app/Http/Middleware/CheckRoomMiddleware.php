<?php namespace ProIMAN\Http\Middleware;

use Closure;
use ProIMAN\Room;

class CheckRoomMiddleware {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		if(Room::whereStatus('0')->get()->isEmpty()){
			return redirect()->route('room.index')->with('redirect_to','" room"');
		}
		return $next($request);
	}

}
