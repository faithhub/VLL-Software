<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LastLogin;
use App\Models\LoginHistory;
use App\Models\Material;
use App\Models\MaterialHistory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class VendorController extends Controller
{
    public function index()
    {
        # code...
        try {
            //code...
            $data['title'] = "All Vendors";
            $data['sn'] = 1;
            $data['vendors'] = $v = User::where("role", "vendor")->with(['bank', 'dom'])->orderBy('created_at', 'DESC')->get();
            return View('dashboard.admin.vendors.index', $data);
        } catch (\Throwable $th) {
            dd($th->getMessage());
            //throw $th;
        }
    }

    public function view($id)
    {
        # code...
        try {
            //code...
            $data['vendor'] = $vendor = User::where(["role" => "vendor", 'id' => $id])->with(['bank', 'dom', 'country', 'profile_pics'])->first();
            if (!$vendor) {
                Session::flash('warning', 'No record found');
                return redirect()->route('admin.vendors');
            }
            $data['title'] = $vendor->name;
            $data['materials'] = Material::where('user_id', $vendor->id)->with(['type', 'file', 'cover', 'vendor'])->orderBy('created_at', "DESC")->get();
            $data['sn'] = 1;
            $data['sn2'] = 1;
            $data['sn3'] = 1;


            $mats = Material::where(['user_id' => $vendor->id, 'price' => 'Paid'])->orderBy('created_at', "DESC")->get();
            $mats_arr = [];
            foreach ($mats as $key => $mat) {
                # code...
                $mat_his = MaterialHistory::where('material_id', $mat->id)->with('trans')->first();

                if ($mat_his) {
                    $object = new \stdClass();
                    $object->mat_his = $mat_his;

                    array_push($mats_arr, $object);
                }
            }
            // dD($vendor);
            $data['login_histories'] = LoginHistory::where('user_id', $vendor->id)->orderBy('created_at', "DESC")->get();
            $data['transactions'] = $mats_arr;
            return View('dashboard.admin.vendors.view', $data);
        } catch (\Throwable $th) {
            dd($th->getMessage());
            //throw $th;
        }
    }

    public function lock_unlock($id, $type, $acc_mode)
    {
        # code...
        try {
            //code...
            $vendor = User::find($id);
            $mode = false;
            $mode_name = "unlocked";

            if (!$vendor) {
                Session::flash('warning', 'No record found');
                return redirect()->back();
            }

            if ($acc_mode == 'lock') {
                # code...
                $mode = true;
                $mode_name = "locked";
            }

            switch ($type) {
                case 'dom':
                    # code...
                    $vendor->dom_acc_verified = $mode;
                    $vendor->save();
                    Session::flash('success', 'Vendor DOM account ' . $mode_name);
                    break;
                case 'naira':
                    # code...
                    $vendor->acc_verified = $mode;
                    $vendor->save();
                    Session::flash('success', 'Vendor Naira account ' . $mode_name);
                    break;

                default:
                    # code...
                    break;
            }

            return redirect()->back();
        } catch (\Throwable $th) {
            dd($th->getMessage());
            //throw $th;
        }
    }
}