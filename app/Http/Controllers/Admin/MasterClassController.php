<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Models\MasterClass;
use App\Models\MaterialHistory;
use App\Models\Meeting;

class MasterClassController extends Controller
{
    //
    public function index()
    {
        # code...
        try {
            //code...
            $data['title'] = "All Masterclass";
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
    public function view($id)
    {
        $object = new \stdClass();
        $object->status = true;
        $data['response'] = $object;
        try {
            $data['class'] = $class = MasterClass::where(['id' => $id])->with(['cover'])->first();
            if (!$class) {
                Session::flash('warning', 'No record found');
                return back() ?? redirect()->route('admin.masterclass.index');
            }
            $meetings_arr = [];
            $details = $class->details;
            // dd($details);
            if (is_array($details)) {
                foreach ($details as $detail) {
                    // dd($detail);
                    if (!empty($detail['meeting_id'])) {
                        $meeting_details = Meeting::where('id', $detail['meeting_id'])->first();
                        $obj = new \stdClass();
                        $obj->id = $detail['id'];
                        $obj->date = $detail['date'];
                        $obj->meeting_id = $detail['meeting_id'];
                        $obj->meeting = $meeting_details;
                        array_push($meetings_arr, $obj);
                    }
                }
            }
            $data['students'] = $students = MaterialHistory::where(['class_id' => $class->id])->with('user')->get();
            $data['meetings_array'] = $meetings_arr;
            $data['title'] = "Vendor Dashboard - " . $class->title;
            return View('dashboard.admin.master-classes.view', $data);
        } catch (\Throwable $th) {
            $object->status = false;
            $object->msg = "Something went wrong, try again!";
            $data['response'] = $object;
            return View('dashboard.admin.master-classes.view', $data);
            Session::flash('warning', $th->getMessage());
            return back() ?? redirect()->route('admin');
            //throw $th;
        }
    }

    public function delete($id)
    {
        try {
            $data['class'] = $class = MasterClass::where(['id' => $id])->first();
            if (!$class) {
                Session::flash('warning', 'No record found');
                return back() ?? redirect()->route('admin.masterclass.index');
            }
            $class->delete();
            Session::flash('success', 'Class deleted');
            return back() ?? redirect()->route('admin.masterclass.index');
        } catch (\Throwable $th) {
            Session::flash('warning', $th->getMessage());
            return back() ?? redirect()->route('admin');
            //throw $th;
        }
    }
}