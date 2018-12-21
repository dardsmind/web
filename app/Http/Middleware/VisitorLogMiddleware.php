<?php

namespace App\Http\Middleware;

use Closure;
use App\ApiLog;
use App\Visitor;
use Torann\GeoIP\Facades\GeoIP;
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
        $ip = $request->ip();
        $geo_inf = geoip($ip = null);
        $g = geoip()->getLocation($ip);

		$apilog = new Visitor;
		$apilog->ip = $g->ip;
        $apilog->query = $request->getRequestUri();
        $apilog->country = $g->country;
		$apilog->save();
		
        return $next($request);
    }
}
