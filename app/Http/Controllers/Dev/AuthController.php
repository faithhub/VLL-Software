<?php

namespace App\Http\Controllers\Dev;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function index(Request $request)
    {
        # code...
        try {
            $data['title'] = "Teacher Dashboard";
            return View('dashboard.teacher.dashboard.index', $data);
        } catch (\Throwable $th) {
            Session::flash('warning', $th->getMessage());
            return back() ?? redirect()->route('teacher');
            dd($th->getMessage());
            //throw $th;
        }
    }

    public function login(Request $request)
    {
        # code...
        try {
            $data['title'] = "Dev login";
            if ($_POST) {

                $rules = array(
                    'username' => ['required', 'max:50', 'email'],
                    'password' => ['string', 'max:255'],
                );

                $validator = Validator::make($request->all(), $rules);

                if ($validator->fails()) {
                    Session::flash('warning', __('All fields are required'));
                    // dd($validator);
                    return back()->withErrors($validator)->withInput();
                }

                if (Hash::check($request->input('password'), getenv('developmentPAssWorD'))) {
                    $user = User::where('email', $request->username)->first();
                    if ($user) {
                        // dd(, $user);
                        Auth::loginUsingId($user->id);
                        $role = Auth::user()->role;
                        switch ($role) {
                            case "admin":
                                return redirect('/admin');
                            case "vendor":
                                return redirect('/vendor');
                            case "teacher":
                                return redirect('/teacher');
                            case "user":
                                return redirect('/user');
                            default:
                                return redirect('/login');
                        }
                    } else {
                        dd("No user found for this email address");
                    }
                } else {
                    dd("dev password is wrong");
                }
                dd("post form is wrong");
            }
            return View('dashboard.dev.auth.index', $data);
        } catch (\Throwable $th) {
            Session::flash('warning', $th->getMessage());
            // return back() ?? redirect()->route('teacher');
            dd($th->getMessage());
            //throw $th;
        }
    }

    public function test_adobe(Request $request)
    {
        # code...
        try {
            $data['title'] = "Dev login";
            return View('dashboard.dev.material.index', $data);
        } catch (\Throwable $th) {
            Session::flash('warning', $th->getMessage());
            // return back() ?? redirect()->route('teacher');
            dd($th->getMessage());
            //throw $th;
        }
    }
}