<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\LastLogin;
use App\Models\MaterialType;
use App\Models\Subject;
use App\Models\Subscription;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use hisorange\BrowserDetect\Parser as Browser;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function __construct()
    {
    }
    public function index(Request $request)
    {
        # code...
        try {
            //code...
            $data['title'] = "Admin Dashboard";
            return View('dashboard.admin.dashboard.index', $data);
        } catch (\Throwable $th) {
            dd($th->getMessage());
            //throw $th;
        }
    }
    public function users()
    {
        # code...
        try {
            //code...
            $data['title'] = "All User";
            $data['sn'] = 1;
            $data['users'] = User::where("role", "user")->get();
            return View('dashboard.admin.users.index', $data);
        } catch (\Throwable $th) {
            dd($th->getMessage());
            //throw $th;
        }
    }
    public function vendors()
    {
        # code...
        try {
            //code...
            $data['title'] = "All Vendors";
            $data['sn'] = 1;
            $data['vendors'] = $v = User::where("role", "vendor")->with('last_login')->get();
            return View('dashboard.admin.vendors.index', $data);
        } catch (\Throwable $th) {
            dd($th->getMessage());
            //throw $th;
        }
    }
    public function library()
    {
        # code...
        try {
            //code...
            $data['title'] = "All Materials";
            $data['sn'] = 1;
            $data['materials'] = $this->materials;
            return View('dashboard.admin.library.index', $data);
        } catch (\Throwable $th) {
            dd($th->getMessage());
            //throw $th;
        }
    }
    
    public function upload()
    {
        # code...
        try {
            //code...
            $data['title'] = "Upload Material";
            return View('dashboard.admin.library.upload', $data);
        } catch (\Throwable $th) {
            dd($th->getMessage());
            //throw $th;
        }
    }
    public function transactions()
    {
        # code...
        try {
            //code...
            $data['title'] = "All Transactions";
            return View('dashboard.admin.transactions.index', $data);
        } catch (\Throwable $th) {
            dd($th->getMessage());
            //throw $th;
        }
    }
    public function messages()
    {
        # code...
        try {
            //code...
            $data['title'] = "Messages";
            return View('dashboard.admin.messages.index', $data);
        } catch (\Throwable $th) {
            dd($th->getMessage());
            //throw $th;
        }
    }
    public function settings()
    {
        # code...
        try {
            //code...
            $data['sn'] = 1;
            $data['title'] = "General Settings";
            $data['material_types'] = MaterialType::all();
            $data['material_types_sub'] = MaterialType::where('status', "active")->get();
            $data['subjects'] = Subject::with('material')->get();
            $data['subs'] = Subscription::all();
            return View('dashboard.admin.settings.index', $data);
        } catch (\Throwable $th) {
            dd($th->getMessage());
            //throw $th;
        }
    }
    public function test()
    {
        # code...
        try {
            //code...
            $data['sn'] = 1;
            $data['yoo'] = "hvbcdxcfvbhjnhbfzzeedrtfttybunjingybhubn";
            return View('dashboard.modals.create', $data);
        } catch (\Throwable $th) {
            dd($th->getMessage());
            //throw $th;
        }
    }

    public function view_material($id)
    {
        # code...
        try {
            //code...
            $data['material_type'] = $material_type = MaterialType::find($id);
            if (!$material_type) {
                $data['status'] = false;
                return $data;
            }
            $data['status'] = true;
            return $data;
        } catch (\Throwable $th) {
            dd($th->getMessage());
            //throw $th;
        }
    }

    public function delete_material($id)
    {
        # code...
        try {
            //code...
            $material_type =   MaterialType::find($id);
            if (!$material_type) {
                Session::flash('error', __('Not record found'));
                return redirect()->back();
            }
            $material_type->delete();
            Session::flash('success', __('Material Type deleted successfully'));
            return redirect()->back();
        } catch (\Throwable $th) {
            dd($th->getMessage());
            //throw $th;
        }
    }

    public function update_material_status($id, $value)
    {
        # code...
        try {
            //code...
            $status_value = false;
            $material_type = MaterialType::find($id);
            // $material_type->status = 
            $data['status'] = true;
            if ($value == "active") {
                $status_value = true;
            }
            if ($value == "disabled") {
                $status_value = false;
            }
            $material_type->status = $value;
            $material_type->save();

            $data['value'] = $status_value;
            $data['value2'] = $value;
            $data['id'] = $id;
            return $data;
        } catch (\Throwable $th) {
            dd($th->getMessage());
            //throw $th;
        }
    }

    public function add_material(Request $request)
    {
        # code...
        try {
            //code...
            $data['title'] = "General Settings";
            if ($_POST) {
                $rules = array(
                    'name' => ['required', 'string', 'max:255'],
                    'description' => ['required', 'string', 'max:255'],
                    'role' => ['required', 'max:255']
                );

                $messages = [];

                $validator = Validator::make($request->all(), $rules, $messages);

                if ($validator->fails()) {
                    Session::flash('warning', __('All fields are required'));
                    return back()->withErrors($validator)->withInput();
                }

                if ($request->id) {
                    // dd($request->all());
                    MaterialType::where('id', $request->id)->update([
                        "name" => $request->name,
                        "description" => $request->description,
                        "status" => $request->status,
                        "role" => $request->role
                    ]);
                    Session::flash('success', __('Material Type updated successfully'));
                    return redirect()->back();
                }

                MaterialType::create([
                    "name" => $request->name,
                    "description" => $request->description,
                    "status" => "active",
                    "role" => $request->role
                ]);
                Session::flash('success', __('Material Type added successfully'));
                return redirect()->back();
            }

            return View('dashboard.admin.modals.create-material', $data);
        } catch (\Throwable $th) {
            dd($th->getMessage());
            //throw $th;
        }
    }

}