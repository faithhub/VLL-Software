<?php

namespace App\Http\Controllers\Dev;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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
