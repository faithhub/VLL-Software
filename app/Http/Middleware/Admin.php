<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Admin
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
        try {
            $role = Auth::user()->role;
            if ($role == "admin" || $role == "sub_admin") {
                return $next($request);
            } else {
                switch ($role) {
                    case "user":
                        // Session::flash('permission_warning', 'You no not have access to this page');
                        return redirect('/user');
                        break;
                    case "vendor":
                        // Session::flash('permission_warning', 'You no not have access to this page');
                        return redirect('/vendor');
                        break;
                    case "teacher":
                        return redirect('/teacher');
                        break;
                    default:
                        break;
                }
            }
        } catch (\Throwable $th) {
            //throw $th;
            dd($th->getMessage());
        }
    }
}