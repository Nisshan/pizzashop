<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsNotUser
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->roleName() != 'User') {
            return $next($request);
        }
        return redirect()->route('home');


    }
}
