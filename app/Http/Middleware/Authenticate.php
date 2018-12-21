<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->guest()) {
			
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            } else {
				if($guard=="token"){
					$response=[
						'status'=>'error',
						'message'=>'invalid request'
					];
					return response(json_encode($response))->header('Content-Type', 'application/json');
				}
                return redirect()->guest('login');
            }
        }

        return $next($request);
    }
}
