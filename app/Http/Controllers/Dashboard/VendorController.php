<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function index()
    {
        # code...
        try {
            //code...
            $data['title'] = "Vendor Dashboard";
            return View('dashboard.vendor.index', $data);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}