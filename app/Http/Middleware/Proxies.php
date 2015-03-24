<?php namespace App\Http\Middleware;

use Closure;

class Proxies {

	public function handle($request, Closure $next)
	{
		$request->setTrustedProxies(['10.0.0.0/8']);

		return $next($request);
	}
}