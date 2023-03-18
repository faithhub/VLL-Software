<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminOnly
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
            $sub_admin = Auth::user()->sub_admin;
            if ($role == "admin") {
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
                    case "user":
                        // Session::flash('permission_warning', 'You no not have access to this page');
                        return redirect('/user');
                        break;
                    case "vendor":
                        // Session::flash('permission_warning', 'You no not have access to this page');
                        return redirect('/vendor');
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
