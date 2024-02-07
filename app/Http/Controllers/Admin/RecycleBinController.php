<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class RecycleBinController extends Controller
{
    public function index()
    {
        # code...
        try {
            $data['materials'] = Material::onlyTrashed()->orderBy('deleted_at', 'DESC')->get();
            return View('dashboard.admin.settings.recycle-bin', $data);
        } catch (\Throwable $th) {
            Session::flash('warning', $th->getMessage());
            return back() ?? redirect()->route('admin');
        }
    }
}