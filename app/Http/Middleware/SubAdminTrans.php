<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubAdminTrans
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
            //code...
            $role = Auth::user()->role;
            $sub_admin = Auth::user()->sub_admin;
            if ($role == "sub_admin" && $sub_admin == "transaction" || $role == "admin") {
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
                        return redirect('/user');
                        break;
                    case "vendor":
                        return redirect('/vendor');
                        break;
                    default:
                        return redirect('/logout');
                        break;
                }
            }
        } catch (\Throwable $th) {
            //throw $th;
            dd($th->getMessage());
        }
    }
}
