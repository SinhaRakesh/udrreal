<?php

namespace App\Http\Middleware;

use Closure;

class MobileNumber
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
        return auth()->user()->mobile != '0000000000'
            ? $next($request) // Will pass user.
            : redirect('/home/mobile'); // Will redirect user to the main page if email is not verified.
    }
}
