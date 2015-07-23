<?php namespace App\Http\Middleware;

use Closure;
use Request;

class IsOwner {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		if ( Request::get('user_id') != Auth::user()->id ){
			abort(403, 'Usted no es propietario del recurso a actualizar');
		}
		
		return $next($request);
	}

}
