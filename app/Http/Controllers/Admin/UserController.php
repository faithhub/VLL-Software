<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LoginHistory;
use App\Models\Material;
use App\Models\MaterialHistory;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{

    public function index()
    {
        # code...
        try {
            //code...
            $data['title'] = "All User";
            $data['sn'] = 1;
            $data['users'] = $user = User::where("role", "user")->with(['last_login', 'sub'])->orderBy('created_at', 'DESC')->orderBy('created_at', "DESC")->get();
            // dd($user[0]->last_login->last());
            return View('dashboard.admin.users.index', $data);
        } catch (\Throwable $th) {
            Session::flash('warning', $th->getMessage());
            return back() ?? redirect()->route('admin');
            dd($th->getMessage());
            //throw $th;
        }
    }

    public function view($id)
    {
        # code...
        try {
            //code...
            $data['user'] = $user = User::where(["role" => "user", 'id' => $id])->with(['country', 'profile_pics'])->first();
            if (!$user) {
                Session::flash('warning', 'No record found');
                return redirect()->route('admin.users');
            }
            $data['sn'] = 1;
            $data['sn2'] = 1;
            $data['sn3'] = 1;
            $data['title'] = $user->name;
            $data['materials'] = MaterialHistory::where('user_id', $user->id)->with(['trans', 'mat'])->orderBy('created_at', "DESC")->get();
            $data['login_histories'] = LoginHistory::where('user_id', $user->id)->orderBy('created_at', "DESC")->get();
            $data['transactions'] = Transaction::where('user_id', $user->id)->orderBy('created_at', "DESC")->get();
            return View('dashboard.admin.users.view', $data);
        } catch (\Throwable $th) {
            Session::flash('warning', $th->getMessage());
            return back() ?? redirect()->route('admin');
            dd($th->getMessage());
            //throw $th;
        }
    }
}