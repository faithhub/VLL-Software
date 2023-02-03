<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FAQ;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class FAQController extends Controller
{
    //

    public function add_faq(Request $request)
    {
        # code...
        try {
            //code...
            $data['title'] = "Create a FAQ";
            if ($_POST) {
                $rules = array(
                    'question' => ['required'],
                    'answer' => ['required'],
                );

                $messages = [];

                $validator = Validator::make($request->all(), $rules, $messages);

                if ($validator->fails()) {
                    Session::flash('warning', __('All fields are required'));
                    return back()->withErrors($validator)->withInput(['tabName' => 'faqDiv']);;
                }

                if ($request->id) {
                    FAQ::where('id', $request->id)->update([
                        "question" => $request->question,
                        "answer" => $request->answer,
                    ]);
                    Session::flash('success', __('FAQ updated successfully'));
                    return redirect()->back()->withInput(['tabName' => 'faqDiv']);
                }

                FAQ::create([
                    "question" => $request->question,
                    "answer" => $request->answer,
                ]);
                Session::flash('success', __('FAQ added successfully'));
                return redirect()->back()->withInput(['tabName' => 'faqDiv']);
            }
            return View('dashboard.admin.modals.create-faq', $data);
        } catch (\Throwable $th) {
            dd($th->getMessage());
            //throw $th;
        }
    }

    public function view_faq($id)
    {
        # code...
        try {
            //code...
            $data['faq'] = $faq = FAQ::find($id);
            if (!$faq) {
                Session::flash('error', "No record found");
                return redirect()->back();
            }
            return View('dashboard.admin.modals.edit-faq', $data);
        } catch (\Throwable $th) {
            dd($th->getMessage());
            //throw $th;
        }
    }

    public function delete_faq($id)
    {
        # code...
        try {
            //code...
            $faq = FAQ::find($id);
            if (!$faq) {
                Session::flash('error', __('Not record found'));
                return redirect()->back()->withInput(['tabName' => 'faqDiv']);
            }
            $faq->delete();
            Session::flash('success', __('FAQ deleted successfully'));
            return redirect()->back()->withInput(['tabName' => 'faqDiv']);
        } catch (\Throwable $th) {
            dd($th->getMessage());
            //throw $th;
        }
    }
}