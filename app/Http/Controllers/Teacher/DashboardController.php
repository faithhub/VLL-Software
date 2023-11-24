<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
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
}