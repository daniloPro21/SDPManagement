<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectTo()
    {
        $user = auth()->user();
        // dd($user);
        if ($user->role == "admin") {
            return route('admin.home');
        } elseif ($user->role == "superadmin") {
            return route('super.home');
        }elseif ($user->role == "secdrh"){
            return route('secdrh.home');
        }
        elseif ($user->role == "secretaire") {
            return route('secretaire.home');
        } elseif ($user->role == "service") {
            return route('service.home');
        }elseif ($user->role == "cardre"){
            return route('service.home');
        } else {
            return route('register');
        }
    }
}
