<?php

namespace App\Http\Middleware;

use Closure;
use DB;
use Auth;
use Request;

class RoleAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function handle($request, Closure $next,$access )
    {
        if(in_array(Auth::user()->id , config('constants.role')[$access])){
            return $next($request);
        }else{
            abort(404);
        }
    }
    
}
