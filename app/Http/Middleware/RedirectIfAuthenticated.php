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
            $role = auth()->user()->role;
            if ($role == "admin") {
                return redirect()->route('admin.home');
            } elseif ($role == 'service') {
                return redirect()->route('service.home');
            } elseif ($role == 'secretaire') {
                return redirect()->route('secretaire.home');
            } else {
                return redirect()->route('register');
            }
        }
        return $next($request);
    }
}