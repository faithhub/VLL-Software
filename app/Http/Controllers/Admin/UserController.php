<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index()
    {
        # code...
        try {
            //code...
            $data['title'] = "All User";
            $data['sn'] = 1;
            $data['users'] = $user = User::where("role", "user")->with(['last_login', 'sub'])->get();
            // dd($user[0]->last_login->last());
            return View('dashboard.admin.users.index', $data);
        } catch (\Throwable $th) {
            dd($th->getMessage());
            //throw $th;
        }
    }
}