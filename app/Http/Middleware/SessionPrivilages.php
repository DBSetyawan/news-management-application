<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use App\Providers\RouteServiceProvider;
use Illuminate\Cookie\Middleware\EncryptCookies as Middleware;

class SessionPrivilages extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function handle($request, Closure $next)
    {
        if (Auth::User()->name == "users") {
            session(['privilages' => 'user']);
            Redis::set('accessable', 'user');
            return $next($request);

        } else {

            session(['privilages' => 'admin']);
            Redis::set('accessable', 'admin');
            return $next($request);
            
        }
    }
}
