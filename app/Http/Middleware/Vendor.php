<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Vendor
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
        $sub_admin = Auth::user()->sub_admin;
        $role = Auth::user()->role;
        if ($role == "vendor") {
            return $next($request);
        } else {
            switch ($role) {
                case "sub_admin":
                    switch ($sub_admin) {
                        case 'user':
                            # code...
                            return redirect('/admin/users');
                            break;
                        case 'transaction':
                            # code...
                            return redirect('/admin/transactions');
                            break;
                        case 'chat':
                            # code...
                            return redirect('/admin/messages');
                            break;
                        case 'material':
                            # code...
                            return redirect('/admin/library');
                            break;
                        default:
                            # code...
                            return redirect('/logout');
                            break;
                    }
                    break;
                case "admin":
                    // Session::flash('permission_warning', 'You no not have access to this page');
                    return redirect('/admin');
                    break;
                case "user":
                    // Session::flash('permission_warning', 'You no not have access to this page');
                    return redirect('/user');
                    break;
                case "teacher":
                    return redirect('/teacher');
                    break;
                default:
                    break;
            }
        }
    }
}