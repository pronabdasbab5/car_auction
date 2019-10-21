<?php

namespace App\Http\Middleware;

use Closure;

class AccessVerifyMiddleware
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
        if (!$request->session()->exists('api_token')) {
            return redirect('user');
        }
        return $next($request);
    }
}
