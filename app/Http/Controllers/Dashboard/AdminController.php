<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\LastLogin;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->materials = array(
            (object) [
                'id' => 7879,
                'title' => 'Constitutional Law',
                'link' => '#',
                'author' => "Daniel Febrigez",
                'year' => '2002',
                'img' => asset('materials/img/001.png')
            ],
            (object) [
                'id' => 7880,
                'title' => 'Introduction to Business Laws',
                'link' => '#',
                'author' => "Daniel Febrigez",
                'year' => '2002',
                'img' => asset('materials/img/002.png')
            ],
            (object) [
                'id' => 7881,
                'title' => 'Constitutional Law',
                'link' => '#',
                'author' => "Daniel Febrigez",
                'year' => '2002',
                'img' => asset('materials/img/003.png')
            ],
            (object) [
                'id' => 7882,
                'title' => 'Constitutional Law',
                'link' => '#',
                'author' => "Daniel Febrigez",
                'year' => '2002',
                'img' => asset('materials/img/004.png')
            ],
            (object) [
                'id' => 7883,
                'title' => 'Introduction to Business Laws',
                'link' => '#',
                'author' => "Daniel Febrigez",
                'year' => '2002',
                'img' => asset('materials/img/005.png')
            ],
            (object) [
                'id' => 7884,
                'title' => 'Constitutional Law',
                'link' => '#',
                'author' => "Daniel Febrigez",
                'year' => '2002',
                'img' => asset('materials/img/006.png')
            ]
        );
    }
    public function index(Request $request)
    {
        # code...
        try {
            //code...
            $data['title'] = "Admin Dashboard";
            return View('dashboard.admin.dashboard.index', $data);
        } catch (\Throwable $th) {
            dd($th->getMessage());
            //throw $th;
        }
    }
    public function users()
    {
        # code...
        try {
            //code...
            $data['title'] = "All User";
            $data['sn'] = 1;
            $data['users'] = User::where("role", "user")->get();
            return View('dashboard.admin.users.index', $data);
        } catch (\Throwable $th) {
            dd($th->getMessage());
            //throw $th;
        }
    }
    public function vendors()
    {
        # code...
        try {
            //code...
            $data['title'] = "All Vendors";
            $data['sn'] = 1;
            $data['vendors'] = $v = User::where("role", "vendor")->with('last_login')->get();
            return View('dashboard.admin.vendors.index', $data);
        } catch (\Throwable $th) {
            dd($th->getMessage());
            //throw $th;
        }
    }
    public function library()
    {
        # code...
        try {
            //code...
            $data['title'] = "All Materials";
            $data['sn'] = 1;
            $data['materials'] = $this->materials;
            return View('dashboard.admin.library.index', $data);
        } catch (\Throwable $th) {
            dd($th->getMessage());
            //throw $th;
        }
    }
    public function upload()
    {
        # code...
        try {
            //code...
            $data['title'] = "Upload Material";
            return View('dashboard.admin.library.upload', $data);
        } catch (\Throwable $th) {
            dd($th->getMessage());
            //throw $th;
        }
    }
    public function transactions()
    {
        # code...
        try {
            //code...
            $data['title'] = "All Transactions";
            return View('dashboard.admin.transactions.index', $data);
        } catch (\Throwable $th) {
            dd($th->getMessage());
            //throw $th;
        }
    }
    public function messages()
    {
        # code...
        try {
            //code...
            $data['title'] = "Messages";
            return View('dashboard.admin.messages.index', $data);
        } catch (\Throwable $th) {
            dd($th->getMessage());
            //throw $th;
        }
    }
    public function settings()
    {
        # code...
        try {
            //code...
            $data['title'] = "General Settings";
            return View('dashboard.admin.settings.index', $data);
        } catch (\Throwable $th) {
            dd($th->getMessage());
            //throw $th;
        }
    }
}