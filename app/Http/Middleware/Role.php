<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, String $role)
    {
        $user = Auth::user();
        if (Auth::check() && $user->role == $role) {
            return $next($request);
        }

        return redirect()->route('admin.home');
    }
}