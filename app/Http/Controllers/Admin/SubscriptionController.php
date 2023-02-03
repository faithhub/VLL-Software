<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MaterialType;
use App\Models\Subject;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;


class SubscriptionController extends Controller
{
    //
    public function edit_subscription($id, Request $request)
    {
        # code...
        try {
            //code...
            $data['sub'] = $sub = Subscription::find($id);

            if (!$sub) {
                Session::flash('warning', __('No record found'));
                return redirect()->route('admin.settings')->withInput(['tabName' => 'subscriptions']);
            }

            if ($_POST) {
                $request->offsetUnset('_token');
                $request->offsetUnset('id');
                $rules = array(
                    'name' => ['required', 'string', 'max:255']
                );

                $messages = [];

                $validator = Validator::make($request->all(), $rules, $messages);

                if ($validator->fails()) {
                    Session::flash('warning', __('All fields are required'));
                    return back()->withErrors($validator)->withInput(['tabName' => 'subscriptions']);
                }

                Subscription::where('id', $request->id)->update($request->all());
                Session::flash('success', __('Subject Type updated successfully'));
                return redirect()->back()->withInput(['tabName' => 'subscriptions']);
            }
            return View('dashboard.admin.modals.edit-sub', $data);
        } catch (\Throwable $th) {
            dd($th->getMessage());
            //throw $th;
        }
    }

    public function view_subscription($id)
    {
        # code...
        try {
            //code...
            $data['material_types_sub'] = MaterialType::where('status', "active")->get();
            $data['subject_type'] = $s = $subject_type = Subject::where('id', $id)->with('material')->first();
            // dd($s);
            if (!$subject_type) {
                Session::flash('error', "No record found");
                return redirect()->back();
            }
            return View('dashboard.admin.modals.edit-sub', $data);
        } catch (\Throwable $th) {
            dd($th->getMessage());
            //throw $th;
        }
    }

    public function delete_subscription($id)
    {
        # code...
        try {
            //code...
            $subject_type =   Subject::find($id);
            if (!$subject_type) {
                Session::flash('error', __('Not record found'));
                return redirect()->back()->withInput(['tabName' => 'subscriptions']);
            }
            $subject_type->delete();
            Session::flash('success', __('Subject Type deleted successfully'));
            return redirect()->back()->withInput(['tabName' => 'subscriptions']);
        } catch (\Throwable $th) {
            dd($th->getMessage());
            //throw $th;
        }
    }
}