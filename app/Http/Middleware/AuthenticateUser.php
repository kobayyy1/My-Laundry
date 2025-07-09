<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticateUser
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::guard('users')->check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $response = $next($request);
        $response->headers->set('Cache-Control','no-cache, no-store, max-age=0, must-revalidate');
        $response->headers->set('Pragma','no-cache');

        return $response;
    }
}
