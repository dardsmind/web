<?php

namespace App\Http\Middleware;

use Closure;
use App\ApiLog;
use App\Visitor;
class VisitorLogMiddleware
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
		//if (! $request->user()->withRole($role)) {
		//   return redirect("/dashboard");
		//}
		$apilog = new Visitor;
		$apilog->ip = $request->ip();
		$apilog->query = $request->getRequestUri();
		$apilog->save();
		
        return $next($request);
    }
}
