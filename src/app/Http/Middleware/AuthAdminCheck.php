<?php namespace App\Http\Middleware;

use Closure;
use App\User;

class AuthAdminCheck {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		if( !User::currentUserIsAdmin() ){
			abort(403, 'Prohibido.');
		}

		return $next($request);
	}

}
