<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        // dd(Auth::user());

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
        $this->transactions = array(
            (object) [
                'id' => 7879,
                'type' => 'Subscription',
                'price' => '6700',
                'author' => "Daniel Febrigez",
                'year' => '2002',
                'img' => asset('materials/img/001.png')
            ],
            (object) [
                'id' => 7879,
                'title' => 'Constitutional Law',
                'price' => '6700',
                'author' => "Daniel Febrigez",
                'year' => '2002',
                'img' => asset('materials/img/001.png')
            ],
        );
        $this->videos = array(
            (object) [
                'id' => 7879,
                'title' => 'Law of Counsel(2002)',
                'link' => '#',
                'author' => "Daniel Febrigez",
                'year' => '2002',
                'img' => asset('materials/img/v-001.png')
            ],
            (object) [
                'id' => 7880,
                'title' => 'Law of Counsel(2002)',
                'link' => '#',
                'author' => "Daniel Febrigez",
                'year' => '2002',
                'img' => asset('materials/img/v-002.png')
            ],
            (object) [
                'id' => 7881,
                'title' => 'Law of Counsel(2002)',
                'link' => '#',
                'author' => "Daniel Febrigez",
                'year' => '2002',
                'img' => asset('materials/img/v-003.png')
            ],
            (object) [
                'id' => 7882,
                'title' => 'Law of Counsel(2002)',
                'link' => '#',
                'author' => "Daniel Febrigez",
                'year' => '2002',
                'img' => asset('materials/img/v-004.png')
            ],
        );
    }

    public function index()
    {
        # code...
        try {
            //code...
            $data['title'] = "User Dashboard - Bookstore";
            $data['materials'] = $this->materials;
            $data['videos'] = $this->videos;
            return View('dashboard.user.bookstore', $data);
        } catch (\Throwable $th) {
            //throw $th;
            dd($th->getMessage());
        }
    }

    public function library()
    {
        # code...
        try {
            //code...
            $data['title'] = "User Dashboard - My Library";
            $data['materials'] = $this->materials;
            return View('dashboard.user.library', $data);
        } catch (\Throwable $th) {
            //throw $th;
            dd($th->getMessage());
        }
    }
    public function transactions()
    {
        # code...
        try {
            //code...
            $data['title'] = "User Dashboard - My Library";
            $data['transactions'] = $this->materials;
            return View('dashboard.user.transactions', $data);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function view_material($id)
    {
        # code...
        try {
            //code...
            $data['title'] = "User Dashboard - My Library";
            $data['transactions'] = $this->materials;
            return View('dashboard.user.view-material', $data);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function summary_material($id)
    {
        # code...
        try {
            //code...
            $data['title'] = "User Dashboard - My Library";
            $data['transactions'] = $this->materials;
            return View('dashboard.user.material-summary', $data);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function subscriptions()
    {
        # code...
        try {
            //code...
            $data['title'] = "Subsciptions";
            $data['subs'] = Subscription::all();
            return View('dashboard.user.subscriptions', $data);
        } catch (\Throwable $th) {
            dD($th->getMessage());
            //throw $th;
        }
    }

    public function help()
    {
        # code...
        try {
            //code...
            $data['title'] = "User Dashboard - Help";
            $data['email'] = "virtuallawlibrary@gmail.com";
            return View('dashboard.user.help', $data);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function settings()
    {
        # code...
        try {
            //code...
            $data['title'] = "User Dashboard - Settings";
            return View('dashboard.user.settings', $data);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}