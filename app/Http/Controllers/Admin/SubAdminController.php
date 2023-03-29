<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class SubAdminController extends Controller
{

    public function index()
    {
        # code...
        try {
            //code...
            $data['title'] = "Sub Admins";
            $data['sn'] = 1;
            $data['users'] = User::where("role", "sub_admin")->get();
            // $data['users'] = [];
            return View('dashboard.admin.sub-admin.index', $data);
        } catch (\Throwable $th) {
            dd($th->getMessage());
            //throw $th;
        }
    }

    public function create(Request $request)
    {
        # code...
        try {
            //code...
            if ($_POST) {
                $rules = array(
                    'name' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'string', 'max:50', 'email', 'unique:users'],
                    'password' => ['required', 'string', 'max:50'],
                    'phone' => ['required', 'string', 'max:50'],
                    'role' => ['required', 'string', 'max:50']
                );

                $messages = [];

                $validator = Validator::make($request->all(), $rules, $messages);

                if ($validator->fails()) {
                    Session::flash('warning', __('All fields are required'));
                    return back()->withErrors($validator)->withInput();
                }
                // dd($request->all());
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'phone' => $request->phone,
                    'role' => "sub_admin",
                    'sub_admin' => $request->role
                ]);

                if (!$user) {
                    # code...
                    Session::flash('warning', __('Something went wrong, try again!'));
                    return back();
                }

                Session::flash('success', __('Created successfully'));
                return redirect()->back()->withInput();
            }
            $data['title'] = "Sub Admins";
            $data['sn'] = 1;
            $data['users'] = User::where("role", "user")->get();
            return View('dashboard.admin.sub-admin.create', $data);
        } catch (\Throwable $th) {
            dd($th->getMessage());
            //throw $th;
        }
    }

    public function delete($id)
    {
        # code...
        try {
            //code...
            $user = User::where(['id' => $id, 'role' => 'sub_admin']);
            if (!$user) {
                Session::flash('error', __('Not record found'));
                return redirect()->back()->withInput();
            }
            $user->delete();
            Session::flash('success', __('Deleted successfully'));
            return redirect()->back();
        } catch (\Throwable $th) {
            dd($th->getMessage());
            //throw $th;
        }
    }
}