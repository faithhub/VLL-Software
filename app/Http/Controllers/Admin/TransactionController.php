<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MaterialHistory;
use App\Models\Subscription;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    //
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
