<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class CheckSessionAccount
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
        if(Session::get(SESSION_KEY_LEVEL)) {
            if(Session::get(SESSION_KEY_LEVEL) > 0){
                return redirect('/');
            }else{
                return redirect('/dashboard-sale-solution');
            }
        }
        return $next($request);
    }
}
