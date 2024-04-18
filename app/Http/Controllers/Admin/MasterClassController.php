<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Models\MasterClass;

class MasterClassController extends Controller
{
    //
    public function index()
    {
        # code...
        try {
            //code...
            $data['title'] = "All Master Classes";
            $data['sn'] = 1;
            $data['materials'] = MasterClass::with(['cover', 'vendor'])->orderBy('created_at', 'DESC')->get();
            return View('dashboard.admin.master-classes.index', $data);
        } catch (\Throwable $th) {
            Session::flash('warning', $th->getMessage());
            return back() ?? redirect()->route('admin');
            dd($th->getMessage());
            //throw $th;
        }
    }
}
