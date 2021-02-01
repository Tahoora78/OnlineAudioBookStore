<?php

namespace App\Http\Middleware;

use Closure;
use DB;
use Auth;

class RoleMarketingMiddleware
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
        $access_count = DB::table('marketing')->where('id_users', Auth::user()->id)->count();
        if ($access_count==0) {
            return redirect()->route('panel.dashboard.index');
        }
        return $next($request);
    }
}
