<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{
    //

    public function index(Type $var = null)
    {
        # code...
        $data['title'] = "Home";
        $data['banner'] = true;
        return View('web.index', $data);
    }
}