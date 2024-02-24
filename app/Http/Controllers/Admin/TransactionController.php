<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MaterialHistory;
use App\Models\Subscription;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TransactionController extends Controller
{

    public function index()
    {
        # code...
        try {
            //code...
            $data['title'] = "All Transactions";
            $data['sn'] = 1;
            $data['transactions'] = Transaction::with(['user'])->orderBy('created_at', 'DESC')->get();
            return View('dashboard.admin.transactions.index', $data);
        } catch (\Throwable $th) {
            Session::flash('warning', $th->getMessage());
            return back() ?? redirect()->route('admin');
            dd($th->getMessage());
            //throw $th;
        }
    }

    public function view($id)
    {
        # code...
        try {
            //code...
            $data['status'] = false;
            $data['tran'] = $tran = Transaction::where('id', $id)->with(['user'])->first();
            if ($tran) {
                $data['status'] = true;
            }
            if ($tran->subscription_id) {
                $data['sub'] = Subscription::find($tran->subscription_id);
            }
            if ($tran->type == "rented" || $tran->type == "bought") {
                // $data['mat_his'] = $mat_his = MaterialHistory::where('invoice_id', $tran->invoice_id)->with(['mat'])->first();
                $data['mat_his'] = $mat_his = MaterialHistory::where('invoice_id', $tran->transaction_id)->with(['mat'])->get('material_id')->first();
                // dd($mat_his, $tran->invoice_id, $mat_his2);
            }
            return View('dashboard.admin.transactions.view', $data);
        } catch (\Throwable $th) {
            Session::flash('warning', $th->getMessage());
            return back() ?? redirect()->route('admin');
            dd($th->getMessage());
            //throw $th;
        }
    }
}