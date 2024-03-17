<?php

namespace App\Http\Controllers\Dev;

// require_once __DIR__ . '../vendor/autoload.php';

use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\Material;
use App\Models\MaterialHistory;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;



class HomeController extends Controller
{
    public function index(Request $request)
    {
        # code...
        try {

            if ($_POST) {

                $rules = array(
                    'name' => ['required', 'string'],
                    'pdfFile' => ['required', 'mimes:pdf', 'max:10000'],
                    // 'folder_cover_id' => ['mimes:jpeg,png,jpg,gif,svg', 'max:50000'],
                );

                $messages = [
                    // 'name.unique' => __('The Folder name has already been taken'),
                    // 'folder_cover_id.required_if' => __('The Folder cover is required'),
                ];

                // dd($request->all());
                $validator = Validator::make($request->all(), $rules, $messages);

                if ($validator->fails()) {
                    $errors = $validator->errors();
                    if ($errors->has('name')) {
                        Session::flash('warning', $errors->first('name'));
                    } else {
                        Session::flash('warning', __('All fields are required'));
                    }
                    return back()->withErrors($validator)->withInput();
                }


                // dd($request->all());

                // $mpdf->Output('filename.pdf');
                // $data = [
                //     'foo' => 'bar'
                // ];
                // $pdf = ProtectPDF::loadView('pdf.document', $data);
                // return $pdf->stream('document.pdf');
            }


            $data['title'] = "Test";
            return View('dev.upload', $data);
        } catch (\Throwable $th) {
            dd($th->getMessage());
            Session::flash('warning', $th->getMessage());
            return back();
            //throw $th;
        }
    }


    public function email_template(Request $request)
    {
        try {
            //code...
            $data['title'] = "Test";
            return View('dev.email-template', $data);
        } catch (\Throwable $th) {
            dd($th->getMessage());
            Session::flash('warning', $th->getMessage());
            return back();
            //throw $th;
            //throw $th;
        }
    }

    public function dev_test(Request $request)
    {
        try {
            //code...

            //code...
            $trans = Transaction::where(['paid_to_vendor' => true, 'status' => 'successful'])->whereIn('type', ['rented', 'bought'])->get();
            foreach ($trans as $key => $value) {

                $mat = MaterialHistory::where(['transaction_id' => $value->id, 'type' => $value->type])->first();
                $matt = Material::where(['id' => $mat->material_id])->first();
                if ($mat->material_id) {
                    if ($mat->type == "rented") {
                        # code...
                        $percentage_rent = \getenv('PERCENTAGE_PAYOUT_FOR_RENTED_BOOK');
                        $payout_amt = ($percentage_rent / 100) * $value->amount;
                    }
                    if ($mat->type == "bought") {
                        # code...
                        $percentage_bought = \getenv('PERCENTAGE_PAYOUT_FOR_BOUGHT_BOOK');
                        $payout_amt = ($percentage_bought / 100) * $value->amount;
                    }
                    $vendor = User::where('id', $matt->user_id)->whereIn('role', ['vendor', 'admin'])->first();
                    if ($vendor && $value->paid_to_vendor == true) {
                        // $wallet = Wallet::where(['user_id' => $vendor->id, 'currency_id' => $value->currency_id ?? 1])->first();
                        // dd($vendor, $payout_amt, $mat, $matt, $wallet, $value);
                        // $wallet->amount = $wallet->amount + $payout_amt;
                        // $wallet->save();
                        $value->amount_paid = $payout_amt;
                        $value->save();
                    }
                }
                # code...
            }
            dd($trans);
        } catch (\Throwable $th) {
            dd($th);
            Session::flash('warning', $th->getMessage());
            return back();
            //throw $th;
        }
    }
    public function dev_test2(Request $request)
    {
        try {
            $users = User::where('role', 'Vendor')->get();
            $curr = Currency::get(['id', 'code']);
            // dd($curr);
            foreach ($users as $key => $value) {
                # code...
                foreach ($curr as $cur) {
                    $wallet = Wallet::where(['user_id' => $value->id, 'currency_id' => $cur->id])->get();
                    if ($wallet->count() == 0) {
                        // dd($cur);
                        $create_new = Wallet::create([
                            'user_id' => $value->id,
                            'currency_id' => $cur->id,
                            'code' => $cur->code
                        ]);
                        // dd("create one", $create_new);
                    }
                }
            }
            dd($users);
        } catch (\Throwable $th) {
            dd($th);
            Session::flash('warning', $th->getMessage());
            return back();
            //throw $th;
            //throw $th;
        }
    }
}