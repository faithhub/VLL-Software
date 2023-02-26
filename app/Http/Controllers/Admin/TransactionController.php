<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MaterialHistory;
use App\Models\Subscription;
use App\Models\Transaction;
use Illuminate\Http\Request;

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
                $data['mat_his'] = MaterialHistory::where('invoice_id', $tran->invoice_id)->with(['mat'])->first();
            }
            return View('dashboard.admin.transactions.view', $data);
        } catch (\Throwable $th) {
            dd($th->getMessage());
            //throw $th;
        }
    }
}