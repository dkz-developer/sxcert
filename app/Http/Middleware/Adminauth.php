<?php

namespace App\Http\Middleware;

use Closure;

class Adminauth
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		$adminInfo = $request->session()->get('adminInfo');
		if(empty($adminInfo))
			return redirect('/admin/login');
		return $next($request);
	}
}
