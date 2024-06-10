<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            // Check if the authenticated user's role is admin
            if (Auth::user()->role === 'admin') {
                return $next($request);
            }
        }

        // If the user is not authenticated or not an admin, redirect them or return an error response
        return redirect()->route('login')->withErrors(['You do not have permission to access this page.']);
    }
}
