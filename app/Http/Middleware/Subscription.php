<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Subscription
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!isset(Auth::user()->sub_id)) {
            switch (Auth::user()->role) {
                case 'user':
                    # code...
                    Session::flash('permission_warning', 'Yo do not have an active subscription, please subscribe and try again!');
                    return redirect('/user/settings');
                    break;
                case 'vendor':
                    # code...
                    Session::flash('permission_warning', 'Yo do not have an active subscription, please subscribe and try again!');
                    return redirect('/vendor/settings');
                    break;
                default:
                    # code...
                    break;
            }
        }
        return $next($request);
    }
}