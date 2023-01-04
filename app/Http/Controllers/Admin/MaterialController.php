<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MaterialType;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class MaterialController extends Controller
{
    //
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
                        "role" => $request->role,
                        "status" => $request->status
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
                return redirect()->back()->withInput(['tabName' => 'materialType']);
            }

            return View('dashboard.admin.modals.create-material', $data);
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
                Session::flash('error', "No record fund");
                return redirect()->back()->withInput(['tabName' => 'materialType']);
            }
            return View('dashboard.admin.modals.edit-material', $data);
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
                return redirect()->back()->withInput(['tabName' => 'materialType']);
            }
            $material_type->delete();
            Session::flash('success', __('Material Type deleted successfully'));
            return redirect()->back()->withInput(['tabName' => 'materialType']);
        } catch (\Throwable $th) {
            dd($th->getMessage());
            //throw $th;
        }
    }

    public function add_subject(Request $request)
    {
        # code...
        try {
            //code...
            $data['title'] = "General Settings";
            $data['material_types_sub'] = MaterialType::where('status', "active")->get();
            if ($_POST) {
                $rules = array(
                    'material_type' => ['required', 'max:255'],
                    'name' => ['required', 'string', 'max:255'],
                    'description' => ['required', 'string', 'max:255']
                );

                $messages = [];

                $validator = Validator::make($request->all(), $rules, $messages);

                if ($validator->fails()) {
                    Session::flash('warning', __('All fields are required'));
                    return back()->withErrors($validator)->withInput(['tabName' => 'subjects']);;
                }

                if ($request->id) {
                    Subject::where('id', $request->id)->update([
                        "material_type_id" => $request->material_type,
                        "name" => $request->name,
                        "description" => $request->description,
                        "status" => $request->status,
                    ]);
                    Session::flash('success', __('Subject Type updated successfully'));
                    return redirect()->back();
                }

                Subject::create([
                    "material_type_id" => $request->material_type,
                    "name" => $request->name,
                    "description" => $request->description,
                    "status" => "active"
                ]);
                Session::flash('success', __('Subject Type added successfully'));
                return redirect()->back()->withInput(['tabName' => 'subjects']);
            }
            return View('dashboard.admin.modals.create-subject', $data);
        } catch (\Throwable $th) {
            dd($th->getMessage());
            //throw $th;
        }
    }

    public function view_subject($id)
    {
        # code...
        try {
            //code...
            $data['material_types_sub'] = MaterialType::where('status', "active")->get();
            $data['subject_type'] = $s = $subject_type = Subject::where('id', $id)->with('material')->first();
            // dd($s);
            if (!$subject_type) {
                Session::flash('error', "No record fund");
                return redirect()->withInput(['tabName' => 'subjects']);
            }
            return View('dashboard.admin.modals.edit-subject', $data);
        } catch (\Throwable $th) {
            dd($th->getMessage());
            //throw $th;
        }
    }

    public function delete_subject($id)
    {
        # code...
        try {
            //code...
            $subject_type =   Subject::find($id);
            if (!$subject_type) {
                Session::flash('error', __('Not record found'));
                return redirect()->withInput(['tabName' => 'subjects']);
            }
            $subject_type->delete();
            Session::flash('success', __('Subject Type deleted successfully'));
            return redirect()->withInput(['tabName' => 'subjects']);
        } catch (\Throwable $th) {
            dd($th->getMessage());
            //throw $th;
        }
    }
}