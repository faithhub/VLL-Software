<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Stevebauman\Location\Facades\Location;

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
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $ip = Request::getClientIp();
        // $loc = Location::get($ip);
        // $countryName = $loc->countryName ?? "";
        // if ($countryName == "Afghanistan") {
        //     return false;
        // }
        $this->middleware('guest')->except('logout');
    }

    public function redirectTo()
    {
        $role = Auth::user()->role;
        switch ($role) {
            case "admin":
                return '/admin';
            case "vendor":
                return '/vendor';
            case "teacher":
                return '/teacher';
            case "user":
                return '/user';
            default:
                return '/login';
        }
    }

    public function logout_now()
    {
        # code...
        return redirect('home')->with(Auth::logout());
    }
}