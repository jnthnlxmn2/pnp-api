<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class admin
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
        if (Auth::user() &&  (Auth::user()->user_type_id == 1) || (Auth::user()->user_type_id == 2)) {
            return $next($request);
        }
        return response('Unauthorized.', 401);
    }
}
