<?php

namespace Alumni\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
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
        // Redirect all user witouth admin (1) role;
        if (auth()->check() && $request->user()->role !== 1) {
            return redirect()->route('home');
        }

        return $next($request);
    }
}
