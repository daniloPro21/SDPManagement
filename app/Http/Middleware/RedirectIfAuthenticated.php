<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            $user = auth()->user();
            if ($user->role == "admin") {
                return redirect()->route('admin.home');
            } elseif ($user->role == "service") {
                return route('service.home');
            } elseif ($user->role == "secretaire") {
                return route('secretaire.home');
            } else {
                return route('register');
            }
        }
        return $next($request);
    }
}