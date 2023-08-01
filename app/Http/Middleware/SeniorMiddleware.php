<?php

namespace App\Http\Middleware;

use Closure;

class SeniorMiddleware
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
        if (auth()->user()->role == "Senior") {
            return $next($request);
        }else{
            return redirect()->back();
        }
    }
}
