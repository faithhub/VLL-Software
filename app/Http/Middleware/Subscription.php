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
        if (Auth::user()->sub->isActive) {
            return $next($request);
        } elseif (Auth::user()->team_id && Auth::user()->team->sub_status == 'active') {
            return $next($request);
        } else {
            Session::flash('permission_warning', 'You do not have an active subscription, please subscribe and try again!');
            return redirect('/user/settings');
        } 
        // return $next($request);
    }
}