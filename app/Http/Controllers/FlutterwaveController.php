<?php

namespace App\Http\Controllers;

use App\Mail\Receipt;
use App\Mail\Withdraw;
use App\Models\Currency;
use App\Models\Folder;
use App\Models\Material;
use App\Models\MaterialHistory;
use App\Models\SubHistory;
use App\Models\Subscription;
use App\Models\Team;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Wallet;
use App\Models\Withdrawal;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class FlutterwaveController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    private function unique_code($limit)
    {
        return substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $limit);
    }

    public function confirm_subscription_transaction()
    {
        try {
            //code...
            $transaction_id = $_GET['transaction_id'];
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . getenv('SECRET_KEY'),
            ])->get('https://api.flutterwave.com/v3/transactions/' . $transaction_id . '/verify');

            // You can access the response body like this:
            $responseBody = $response->json();

            if ($responseBody['status'] == "error") {
                Session::flash('warning', $responseBody['message']);
                return back() ?? redirect()->route('user');
            }

            $tx_ref = $responseBody['data']['tx_ref'];
            $trans = Transaction::where('trxref', $tx_ref)->first();
            $sub_data = strstr($tx_ref, "@", true);
            $sub_id = strstr($sub_data, "#", true);
            $type = substr($sub_data, strpos($sub_data, "#") + 1);
            $tx_ref = substr($tx_ref, strpos($tx_ref, "@") + 1);
            $user_type = "";

            $invoice_id = Str::upper("TRX" . $this->unique_code(12));

            Transaction::create([
                'user_id' => Auth::user()->id,
                'invoice_id' => $invoice_id,
                'subscription_id' => $sub_id,
                'date' => $responseBody['data']['created_at'],
                'amount' => $responseBody['data']['amount'],
                'status' => $responseBody['data']['status'],
                'currency_id' => Auth::user()->currency->id,
                'reference' => $responseBody['data']['id'],
                'trxref' => $tx_ref,
                'type' => 'subscription'
            ]);


            if (
                $responseBody['data']['status'] != "successful"
            ) {
                # code...
                Session::flash('warning', "Payment faild");
                return back();
            }

            switch (Auth::user()->role) {
                case 'user':
                    # code...
                    $data['status'] = true;
                    $subscription_id = $sub_id;
                    $type = $type;
                    $amount = null;
                    $date = Carbon::now();
                    $invoice_id = Str::upper("TRX" . $this->unique_code(12));
                    $end_date = null;

                    $sub = Subscription::find($subscription_id);
                    if (!$sub) {
                        # code...
                        Session::flash('warning', "No subscription found");
                        return back() ?? redirect()->route('user');
                    }

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

                    $data['user'] = User::where('id', Auth::user()->id)->update(['sub_id' => $save_sub->id, 'team_id' => $team_id ?? null]);

                    Session::flash('success', "Payment Successful");
                    return redirect()->route('user.settings');
                    break;

                default:
                    # code...
                    break;
            }

            return $responseBody;
        } catch (\Throwable $th) {
            dd($th);
            Session::flash('warning', 'Something went wrong');
            return back() ?? redirect()->route('user');
        }
    }

    public function confirm_material_transaction()
    {
        try {
            //code...
            $rented_days = \getenv('RENTED_DAYS');
            $transaction_id = $_GET['transaction_id'];
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . getenv('SECRET_KEY'),
            ])->get('https://api.flutterwave.com/v3/transactions/' . $transaction_id . '/verify');


            // You can access the response body like this:
            $responseBody = $response->json();

            if ($responseBody['status'] == "error") {
                Session::flash('warning', $responseBody['message']);
                return back() ?? redirect()->route('user');
            }

            $tx_ref = $responseBody['data']['tx_ref'];
            $trans = Transaction::where('trxref', $tx_ref)->first();
            $amount = $responseBody['data']['amount'];
            $status = $responseBody['data']['status'];
            $reference = $tx_ref;
            $mat_data = strstr($tx_ref, "@", true);
            $mat_id = strstr($mat_data, "#", true); //get material id
            $type = substr($mat_data, strpos($mat_data, "#") + 1); //get payment type (buy or rent)
            $tx_ref = substr($tx_ref, strpos($tx_ref, "@") + 1); //get payment ref

            $invoice_id = Str::upper("TRX" . $this->unique_code(12));

            $check_trans = Transaction::where('trxref', $tx_ref)->get();
            if ($check_trans->count() < 1) {
                $curr_used = Currency::where('code', $responseBody['data']['currency'])->first();
                $trans = Transaction::create([
                    'user_id' => Auth::user()->id,
                    'invoice_id' => $invoice_id,
                    'material_id' => $mat_id,
                    'date' => $responseBody['data']['created_at'],
                    'amount' => $responseBody['data']['amount'],
                    'status' => $responseBody['data']['status'],
                    'currency_id' => $curr_used->id,
                    'reference' => $responseBody['data']['id'],
                    'trxref' => $tx_ref,
                    'type' => $type
                ]);
            } else {
                $trans = $check_trans->first();
            }


            if (
                $responseBody['data']['status'] != "successful"
            ) {
                # code...
                Session::flash('warning', "Payment faild");
                return back() ?? redirect()->route('user');
            }

            // $data['mat_id'] = $mat_id = $request->mat_id;
            // $data['reference'] = $reference =  $request->reference;
            // $data['status'] = $status = $request->status;
            // $data['trxref'] = $trxref = $request->trxref;
            // $data['amount'] = $amount = $request->amount;
            // $data['type'] = $type = $request->type;

            $rent_count = 0;
            $folder_id = null;
            $mat_type = "material";
            $rent_unique_id = 0;
            $currency = $responseBody['data']['currency'];

            switch ($type) {
                case 'rented':
                    # code...
                    $mat_details = Material::find($mat_id);
                    $date_rented_expired = Carbon::now()->addDays($rented_days);
                    $rent_unique_id = Str::upper("TRX" . $this->unique_code(17));
                    $folder_id = null;

                    //Calc payment for rented material to vendore wallets
                    $percentage = \getenv('PERCENTAGE_PAYOUT_FOR_RENTED_BOOK');
                    $payout_for_mat = ($percentage / 100) * $responseBody['data']['amount'];
                    break;

                case 'bought':
                    # code...
                    $type = "bought";
                    $mat_details = Material::find($mat_id);
                    $folder_id = null;

                    //Calc payment for bought material to vendore wallets
                    $percentage = \getenv('PERCENTAGE_PAYOUT_FOR_BOUGHT_BOOK');
                    $payout_for_mat = ($percentage / 100) * $responseBody['data']['amount'];
                    break;

                case 'folder':
                    # code...
                    $type = "bought";
                    $mat_type = "folder";
                    $folder = Folder::find($mat_id);
                    $mat_details = $folder;
                    $mat_id = null;
                    $folder_id = $folder->id;

                    //Payment for folder material to vendor wallets
                    $percentage = \getenv('PERCENTAGE_PAYOUT_FOR_FOLDER_BOOK');
                    $payout_for_mat = ($percentage / 100) * $responseBody['data']['amount'];

                    switch ($folder->duration) {
                        case 'annual':
                            # code...
                            //Set to expired in a year's time, but working on updates to accept monthly as well
                            $folder_expired_date = Carbon::now()->addMonths(12);
                            break;
                        case 'quarterly':
                            # code...
                            //Set to expired in a year's time, but working on updates to accept monthly as well
                            $folder_expired_date = Carbon::now()->addMonths(3);
                            break;
                        case 'monthly':
                            # code...
                            //Set to expired in a year's time, but working on updates to accept monthly as well
                            $folder_expired_date = Carbon::now()->addMonths(1);
                            break;

                        default:
                            # code...
                            break;
                    }

                    $isFolderExpired = false;
                    break;

                default:
                    # code...
                    break;
            }

            if (!$mat_details) {
                Session::flash('warning', 'Unable to confirm payment');
                return back() ?? redirect()->route('user');
            }

            $vendor = User::where(['id' => $mat_details->user_id])->first();

            if (!$trans->amount_paid) {
                if ($vendor->role == "vendor" || $vendor->role == "admin" || $vendor->role == "sub_admin") {
                    $wallet = Wallet::where(['user_id' => $vendor->id, 'code' => $currency])->first();
                    if ($wallet) {
                        $wallet->amount = $wallet->amount + $payout_for_mat; //save to vendor wallet if wallet does exist
                        $save_with = $wallet->save();
                        if ($save_with) {
                            $trans->paid_to_vendor = true;
                            $trans->amount_paid = $payout_for_mat;
                            $trans->save();
                        }
                    } else {
                        $curr = Currency::where('code', $currency)->first(); //create wallet and save to vendor wallet
                        $new_wallet = Wallet::create([
                            'user_id' => $vendor->id,
                            'currency_id' => $curr->id,
                            'code' => $currency,
                            'amount' => $payout_for_mat
                        ]);
                        if ($new_wallet->id) {
                            $trans->paid_to_vendor = true;
                            $trans->amount_paid = $payout_for_mat;
                            $trans->save();
                        }
                    }
                }
            }

            $data['invoice_id'] = $invoice_id = Str::upper("TRX" . $this->unique_code(12));
            $data['date'] = $date = Carbon::now();


            $my_materials_arr = [];
            $my_materials = MaterialHistory::where(['user_id' => Auth::user()->id, 'is_rent_expired' => false])->get('material_id');
            foreach ($my_materials as $key => $value) {
                # code...
                array_push($my_materials_arr, $value->material_id);
            }

            $object = new \stdClass();
            $object->name = Auth::user()->name;
            $object->currency = $responseBody['data']['currency'];
            $object->amount = $responseBody['data']['amount'];
            $object->date = $responseBody['data']['created_at'];
            $object->type = $type;
            $object->mat_type = $mat_type;
            $object->payment_type = 'material_trans';
            if ($type == 'rented') {
                $object->expires_on = $date_rented_expired;
            }
            if ($mat_type == 'folder') {
                $object->material = $mat_details->name;
            } else {
                $object->material = $mat_details->title;
            }
            $object->ref = $tx_ref;

            Mail::to(Auth::user()->email)->send(new Receipt($object));

            MaterialHistory::create([
                'user_id' => Auth::user()->id,
                'material_id' => $mat_id,
                'folder_id' => $folder_id,
                'transaction_id' => $trans->id,
                'invoice_id' => $invoice_id,
                'unique_id' => Str::upper("MATHIS" . $this->unique_code(12)),
                'rent_count' => $rent_count,
                'rent_unique_id' => $rent_unique_id,
                'date_rented_expired' => $date_rented_expired ?? 0,
                'type' => $type,
                'folder_expired_date' => $folder_expired_date ?? 0,
                'isFolderExpired' => $isFolderExpired ?? false,
                'mat_type' => $mat_type
            ]);

            Session::flash('success', "Payment Successful");
            return redirect()->route('user.library');
        } catch (\Throwable $th) {
            dd($th);
            Session::flash('warning', 'Something went wrong');
            return back() ?? redirect()->route('user');
        }
    }

    public function user_subscribe($sub_id, $tx_ref, $type, $request)
    {
        try {
            //code...
            // dd($request, $sub_id, $tx_ref, $type,);
            $data['status'] = true;
            $subscription_id = $sub_id;
            $type = $type;
            $reference = $request['id'];
            $status = $request['status'];
            $trxref = $tx_ref;

            $amount = null;
            $date = Carbon::now();
            $invoice_id = Str::upper("TRX" . $this->unique_code(12));
            $end_date = null;

            Transaction::create([
                'user_id' => Auth::user()->id,
                'invoice_id' => $invoice_id,
                'subscription_id' => $subscription_id,
                'date' => $request['created_at'],
                'amount' => $request['amount'],
                'status' => $status,
                'currency_id' => Auth::user()->currency->id,
                'reference' => $reference,
                'trxref' => $trxref,
                'type' => 'subscription'
            ]);


            if ($status != "successful") {
                # code...
                Session::flash('warning', "Payment faild");
                return back() ?? redirect()->route('user');
            }

            // if (!($subscription_id && $type)) {
            //     $data['status'] = false;
            //     return $data;
            // }

            $sub = Subscription::find($subscription_id);
            if (!$sub) {
                # code...
                Session::flash('warning', "No subscription found");
                return back() ?? redirect()->route('user');
            }

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

            $data['user'] = User::where('id', Auth::user()->id)->update(['sub_id' => $save_sub->id, 'team_id' => $team_id ?? null]);

            Session::flash('warning', "Payment Successful");
            return route('user.settings');
        } catch (\Throwable $th) {
            dd($th);
            //throw $th;
            Session::flash('warning', $th->getMessage());
            return back() ?? redirect()->route('user');
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

    public function withdraw(Request $request)
    {
        try {
            //code...
            $currency = $request->currency ?? null;
            $currency_id = $request->currency_id ?? null;
            $amount = $request->amount ?? null;
            $percentage = \getenv('PERCENTAGE_BANK_CHARGE_FOR_WITHDRAWALS'); //Withdrawal percentage 
            $NGN_max = \getenv('NGN_MAX_PAYOUT');
            $USD_max = \getenv('USD_MAX_PAYOUT');

            switch ($currency) {
                case 'NGN':
                    # code...
                    $rules = array(
                        'currency' => ['required', 'string'],
                        'currency_id' => ['required', 'string'],
                        'amount' => ['required', 'numeric', 'min:' . $NGN_max],
                    );

                    $messages = [
                        'amount.min' => __('The minimun payout amount is ' . $currency . number_format($NGN_max, 2)),
                    ];
                    break;
                case 'USD':
                    # code...
                    $rules = array(
                        'currency' => ['required', 'string'],
                        'currency_id' => ['required', 'string'],
                        'amount' => ['required', 'numeric', 'min:' . $USD_max],
                    );

                    $messages = [
                        'amount.min' => __('The minimun payout amount is ' . $currency . number_format($USD_max, 2)),
                    ];
                    break;

                default:
                    Session::flash('warning', 'Currency not found');
                    return back() ?? redirect()->route('vendor.payouts') ?? redirect()->route('vendor');
                    # code...
                    break;
            }

            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                $errors = $validator->errors();
                if ($errors->has('amount')) {
                    Session::flash('warning', $errors->first('amount'));
                } else {
                    Session::flash('warning', __('All fields are required'));
                }
                return back()->withErrors($validator)->withInput();
            }

            //Reference number
            $randomNumber = Str::upper("TRX" . $this->unique_code(12));
            $narration = "VLL Withdrawal";
            $reference = "VLL-PAYOUT-" . $randomNumber;

            //Check if user has enough money to withdraw
            $wallet = Wallet::where(['id' => $currency_id, 'code' => $currency, 'user_id' => Auth::user()->id])->first();
            if (!$wallet) {
                Session::flash('warning', 'Wallet not found');
                return back() ?? redirect()->route('vendor.payouts') ?? redirect()->route('vendor');
            }

            if (!($wallet->amount >= $amount)) {
                Session::flash('warning', 'You do not have enough fund to withdraw');
                return back() ?? redirect()->route('vendor.payouts') ?? redirect()->route('vendor');
            }

            //Debit the user wallet
            $percentage = \getenv('PERCENTAGE_BANK_CHARGE_FOR_WITHDRAWALS'); //Withdrawal percentage
            $percentage_for_payout = ($percentage / 100) * $amount;
            $payable_amount = $amount - $percentage_for_payout;
            $wallet->amount = $wallet->amount - $amount;

            //Check if the currency is USD or NGN
            switch ($currency) {
                case 'NGN':
                    # code...
                    //Check if the user meet up with Min amount to withdraw
                    if ($amount < $NGN_max) {
                        Session::flash('warning', 'The minimun payout amount is ' . $currency . number_format($NGN_max, 2));
                        return back();
                    }
                    $account_bank = Auth::user()->bank->code;
                    $account_number = Auth::user()->acc_number;
                    break;
                case 'USD':
                    # code...
                    //Check if the user meet up with Min amount to withdraw
                    if ($amount < $USD_max) {
                        Session::flash('warning', 'The minimun payout amount is ' . $currency . number_format($USD_max, 2));
                        return back();
                    }
                    $account_bank = Auth::user()->dom_bank_id->code;
                    $account_number = Auth::user()->dom_acc_number;
                    break;

                default:
                    # code...
                    Session::flash('warning', 'Currency not found');
                    return back();
                    break;
            }

            // dd($account_bank);
            $params = [
                "account_bank" => "044",
                "account_number" => "0690000040",
                // "account_bank" => $account_bank,
                // "account_number" => $account_number,
                "amount" => $payable_amount,
                "narration" => $narration,
                "currency" => $currency,
                "reference" => $reference,
                "callback_url" => "https://www.flutterwave.com/ng/",
                "debit_currency" => $currency
            ];

            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . getenv('SECRET_KEY'),
            ])->post('https://api.flutterwave.com/v3/transfers', $params);


            // You can access the response body like this:
            $responseBody = $response->json();

            $response_status = $responseBody['status'];
            // dd($responseBody['data'], $responseBody);
            
            switch ($response_status) {
                case 'error':
                    # code...
                    // dd($responseBody, $responseBody['data']);
                    Withdrawal::create([
                        "user_id" => Auth::user()->id,
                        "wallet_id" => $wallet->id,
                        "tran_id" => Str::upper("TRX" . $this->unique_code(12)),
                        "status" => $responseBody['data']['status'],
                        "amount_paid" => $responseBody['data']['amount'],
                        "fee" => $responseBody['data']['fee'],
                        "amount_withdraw" => $amount
                    ]);
                    Session::flash('warning', $responseBody['message']);
                    return back() ?? redirect()->route('vendor.payouts') ?? redirect()->route('vendor');
                    break;
                case 'success':
                    # code...
                    //Debit the user waller
                    $save_wallet = $wallet->save();

                    if ($save_wallet) {
                        //Send Mail
                        $object = new \stdClass();
                        $object->name = Auth::user()->name;
                        $object->currency = $responseBody['data']['currency'];
                        $object->amount = $amount;
                        $object->fee = $responseBody['data']['fee'];
                        $object->date = $responseBody['data']['created_at'];
                        $object->ref = $responseBody['data']['reference'];
                        $object->acc_name = $responseBody['data']['full_name'];
                        $object->bank = $responseBody['data']['bank_name'];
                        $object->acc_num = $responseBody['data']['account_number'];
                        $object->payment_type = 'withdraw';

                        Mail::to(Auth::user()->email)->send(new Withdraw($object));

                        //Save record to payout table
                        Withdrawal::create([
                            "user_id" => Auth::user()->id,
                            "wallet_id" => $wallet->id,
                            "tran_id" => $responseBody['data']['reference'],
                            "status" => $responseBody['data']['status'],
                            "amount_paid" => $responseBody['data']['amount'],
                            "fee" => $responseBody['data']['fee'],
                            "account_paid_to" => $responseBody['data'],
                            "amount_withdraw" => $amount
                        ]);

                        //Sent success response
                        Session::flash('success', $responseBody['message']);
                        return redirect()->route('vendor.payouts');
                    } else {
                        //Sent error response
                        Session::flash('error', 'An error occur');
                        return redirect()->route('vendor.payouts');
                    }
                    //Send PDF to email
                    break;

                default:
                    # code...
                    break;
            }

            Session::flash('warning', 'Try again!');
            return redirect()->route('vendor.payouts');

            // if ($responseBody['status'] == "error") {
            // }
        } catch (\Throwable $th) {
            dd($th);
            //throw $th;
        }
    }
}