<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class VendorController extends Controller
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
            $data['title'] = "Vnedor Dashboard - My Library";
            $data['materials'] = $this->materials;
            $data['videos'] = $this->videos;
            $data['materials'] = $this->materials;
            return View('dashboard.vendor.library', $data);
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
            $data['title'] = "Vnedor Dashboard - My Library";
            $data['materials'] = $this->materials;
            return View('dashboard.vendor.library', $data);
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
            $data['title'] = "Vnedor Dashboard - My Library";
            $data['transactions'] = $this->materials;
            return View('dashboard.vendor.transactions', $data);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function view_material($id)
    {
        # code...
        try {
            //code...
            $data['title'] = "Vnedor Dashboard - My Library";
            $data['transactions'] = $this->materials;
            return View('dashboard.vendor.view-material', $data);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function summary($id)
    {
        # code...
        try {
            //code...
            $data['title'] = "Vnedor Dashboard - My Library";
            $data['transactions'] = $this->materials;
            return View('dashboard.vendor.material-summary', $data);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function help()
    {
        # code...
        try {
            //code...
            $data['title'] = "Vnedor Dashboard - Help";
            $data['email'] = "virtuallawlibrary@gmail.com";
            return View('dashboard.vendor.help', $data);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function settings()
    {
        # code...
        try {
            //code...
            $data['banks'] = Bank::all();
            // $data['banks'] = $response = Http::get("https://api.paystack.co/bank");
            // $all_banks = $response->json($key = null);
            // dd($response->body(), $all_banks['data']);
            // dd($all_banks['data']);
            // foreach ($all_banks['data'] as $bank) {
            //     # code...
            //     Bank::create([
            //         "name" => $bank['name'],
            //         "slug" => $bank['slug'],
            //         "code" => $bank['code'],
            //         "longcode" => $bank['longcode'],
            //         "gateway" => $bank['gateway'],
            //         "pay_with_bank" => $bank['pay_with_bank'],
            //         "active" => $bank['active'],
            //         "country" => $bank['country'],
            //         "currency" => $bank['currency'],
            //         "type" => $bank['type'],
            //         "is_deleted" => $bank['is_deleted'],
            //         "created_at" => $bank['createdAt'],
            //         "updated_at" => $bank['updatedAt']
            //     ]);
            // }
            $data['title'] = "User Dashboard - Settings";
            return View('dashboard.vendor.settings', $data);
        } catch (\Throwable $th) {
            //throw $th;
            dd($th->getMessage());
        }
    }
    public function upload()
    {
        # code...
        try {
            //code...
            $data['title'] = "User Dashboard - Upload Material";
            return View('dashboard.vendor.upload', $data);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}