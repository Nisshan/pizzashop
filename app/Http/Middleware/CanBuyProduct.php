<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CanBuyProduct
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
        if (auth()->check()) {
            if (auth()->user()->roleName() != 'User') {
                return redirect()->route('dashboard');
            }
            return $next($request);
        }
        return $next($request);
    }
}
