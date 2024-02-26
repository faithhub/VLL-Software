<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MaterialHistory;
use App\Models\Subscription;
use App\Models\Transaction;
use App\Models\Wallet;
use App\Models\Withdrawal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            $data['status'] = true;
            $data['tran'] = $tran = Transaction::where('id', $id)->with(['user'])->first();
            if (!$tran) {
                $data['status'] = false;
            }
            if ($tran->subscription_id) {
                $data['sub'] = Subscription::find($tran->subscription_id);
            }
            if ($tran->type == "rented" || $tran->type == "bought") {
                // $data['mat_his'] = $mat_his = MaterialHistory::where('invoice_id', $tran->invoice_id)->with(['mat'])->first();
                $data['mat_his'] = $mat_his = MaterialHistory::where('transaction_id', $tran->id)->with(['mat'])->get('material_id')->first();
            }
            if ($tran->type == "folder") {
                $data['mat_folder'] = $mat_folder = MaterialHistory::where('transaction_id', $tran->id)->with(['folder'])->get('folder_id')->first();
            }

            return View('dashboard.admin.transactions.view', $data);
        } catch (\Throwable $th) {
            Session::flash('warning', $th->getMessage());
            return back() ?? redirect()->route('admin');
            dd($th->getMessage());
            //throw $th;
        }
    }


    public function payouts()
    {
        # code...
        try {
            //code...
            $data['title'] = "Vendor Dashboard - Payouts";
            $data['sn'] = 1;
            // $data['wallets'] = Wallet::with('currency')->get();
            $data['withdrawals'] = Withdrawal::orderBy('id', 'DESC')->with(['wallet', 'vendor'])->get();
            return View('dashboard.admin.payouts.index', $data);
        } catch (\Throwable $th) {
            Session::flash('warning', $th->getMessage());
            return back() ?? redirect()->route('vendor');
            //throw $th;
        }
    }

    public function view_payout($id)
    {
        # code...
        try {
            //code...
            $data['title'] = "Vendor Dashboard - View Payout";
            $data['status'] = true;
            $data['trans'] = $withdrawal = Withdrawal::where('id', $id)->with(['wallet', 'vendor'])->first();
            if (!$withdrawal) {
                $data['status'] = false;
            }
            return View('dashboard.admin.payouts.view', $data);
        } catch (\Throwable $th) {
            Session::flash('warning', $th->getMessage());
            return back() ?? redirect()->route('vendor');
            //throw $th;
        }
    }
}