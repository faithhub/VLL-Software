<?php

namespace App\Http\Controllers;

use App\Models\SubHistory;
use App\Models\Subscription;
use App\Models\Team;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class FlutterwaveController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function confirm()
    {
        // $response = Http::get('https://api.flutterwave.com/v3/transfers/rates?amount=1000&destination_currency=USD&source_currency=KES');
        // $response->header('Authorization: Bearer FLWPUBK_TEST-006e9a2dde4eb5947f2da2af0c2f3695-X');

        // dd($response);
        # code...
        try {
            //code...
            $tx_ref = $_GET['tx_ref'];
            $trans = Transaction::where('trxref', $tx_ref)->first();
            dd($_GET, $trans);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function save_transaction(Request $request)
    {
        try {
            //code...
            $subscription_id = $request->sub_id;
            $reference = $request->reference;
            $status = $request->status;
            $trxref = $request->trxref;
            $date = Carbon::now();

            $sub = Subscription::find($subscription_id);

            $data = [
                'user_id' => Auth::user()->id,
                'invoice_id' => $request->invoice_id,
                'subscription_id' => $sub->id,
                'date' => $date,
                'currency_id' => Auth::user()->currency->code,
                'amount' => $request->amount,
                'status' => $status,
                'reference' => $reference,
                'trxref' => $trxref,
                'type' => 'subscription'
            ];

            return $data;

            // Transaction::create($data);
        } catch (\Throwable $th) {
            return $th->getMessage();
            //throw $th;
        }
    }

    public function subscribe(Request $request)
    {
        try {
            //code...
            $data['status'] = true;
            $subscription_id = $request->sub_id;
            $type = $request->type;
            $reference = $request->reference;
            $status = $request->status;
            $trxref = $request->trxref;

            if (!($subscription_id && $type)) {
                $data['status'] = false;
                return $data;
            }

            $sub = Subscription::find($subscription_id);
            $amount = null;
            $date = Carbon::now();
            $invoice_id = Str::upper("TRX" . $this->unique_code(12));
            $end_date = null;

            if ($sub->type == 'student') {
                switch ($type) {
                    case 'session':
                        $amount = $sub->session;
                        $end_date = Carbon::now()->addMonths($sub->session_duration);
                        # code...
                        break;
                    case 'system':
                        $amount = $sub->system;
                        $end_date = Carbon::now()->addMonths($sub->system_duration);
                        # code...
                        break;

                    default:
                        # code...
                        break;
                }
            }

            if ($sub->type == 'professional') {
                switch ($type) {
                    case 'annual':
                        $amount = $sub->annual;
                        $end_date = Carbon::now()->addMonths(12);
                        # code...
                        break;
                    case 'quarterly':
                        $amount = $sub->quarterly;
                        $end_date = Carbon::now()->addMonths(4);
                        # code...
                        break;
                    case 'monthly':
                        $amount = $sub->monthly;
                        $end_date = Carbon::now()->addMonths(1);
                        # code...
                        break;
                    case 'weekly':
                        $amount = $sub->weekly;
                        $end_date = Carbon::now()->addWeek();
                        # code...
                        break;

                    default:
                        # code...
                        break;
                }
            }

            $save_sub = SubHistory::create([
                'user_id' => Auth::user()->id,
                'plan_id' => $sub->id,
                'subscription_id' => $sub->id,
                'date_subscribed' => $date,
                'start_date' => $date,
                'expired_date' => $end_date,
                'isActive' => true
            ]);

            Transaction::create([
                'user_id' => Auth::user()->id,
                'invoice_id' => $invoice_id,
                'subscription_id' => $sub->id,
                'date' => $date,
                'amount' => $amount,
                'status' => $status,
                'reference' => $reference,
                'trxref' => $trxref,
                'type' => 'subscription'
            ]);

            if ($sub->type == 'professional' && $sub->max_teammate > 1) {
                # code...
                if (Auth::user()->team_id) {
                    # code...
                    $team = Team::find(Auth::user()->team_id);
                    $team->subscription_id = $sub->id;
                    $team->start_date = $date;
                    $team->end_date = $end_date;
                    $team->sub_status = "active";
                    $team->save();
                } else {
                    # code...
                    $team = Team::create([
                        'user_id' => Auth::user()->id,
                        'subscription_id' => $sub->id,
                        'teammates' => [Auth::user()->email],
                        'start_date' => $date,
                        'end_date' => $end_date,
                        'sub_status' => "active"
                    ]);
                }
                $team_id = $team->id;
                User::where('id', Auth::user()->id)->update(['sub_id' => $save_sub->id, 'team_id' => $team_id ?? null, 'team_admin' => true]);
            } elseif ($sub->type == 'professional' && $sub->max_teammate == 1) {
                if (Auth::user()->team_id) {
                    # code...
                    $team = Team::find(Auth::user()->team_id);
                    foreach ($team->teammates as $key => $value) {
                        # code...
                        User::where('email', $value)->update(['team_id' => null]);
                    }
                    $team->teammates = [Auth::user()->email];
                    $team->subscription_id = $sub->id;
                    $team->start_date = $date;
                    $team->end_date = $end_date;
                    $team->sub_status = "active";
                    $team->save();
                } else {
                    # code...
                    $team = Team::create([
                        'user_id' => Auth::user()->id,
                        'subscription_id' => $sub->id,
                        'teammates' => [Auth::user()->email],
                        'start_date' => $date,
                        'end_date' => $end_date,
                        'sub_status' => "active"
                    ]);
                }
                $team_id = $team->id;
                User::where('id', Auth::user()->id)->update(['sub_id' => $save_sub->id, 'team_id' => $team_id ?? null, 'team_admin' => true]);
            }

            User::where('id', Auth::user()->id)->update(['sub_id' => $save_sub->id, 'team_id' => $team_id ?? null]);

            return $data;
        } catch (\Throwable $th) {
            //throw $th;
            return $th->getMessage();
        }
    }
}