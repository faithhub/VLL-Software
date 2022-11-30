<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        # code...
        try {
            //code...
            $data['title'] = "Admin Dashboard";
            return View('dashboard.admin.index', $data);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}