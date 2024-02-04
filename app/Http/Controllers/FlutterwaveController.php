<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use App\Models\MaterialHistory;
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

    private function unique_code($limit)
    {
        return substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $limit);
    }

    public function confirm()
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

    public function confirm_material()
    {
        try {
            //code...
            $transaction_id = $_GET['transaction_id'];
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . getenv('SECRET_KEY_NEW'),
            ])->get('https://api.flutterwave.com/v3/transactions/' . $transaction_id . '/verify');


            // You can access the response body like this:
            $responseBody = $response->json();

            if ($responseBody['status'] == "error") {
                Session::flash('warning', $responseBody['message']);
                return back() ?? redirect()->route('user');
            }

            // dd(
            //     $responseBody,
            //     $transaction_id
            // );

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

            // dd($responseBody, $mat_id, $type, $tx_ref);
            $trans = Transaction::create([
                'user_id' => Auth::user()->id,
                'invoice_id' => $invoice_id,
                'material_id' => $mat_id,
                'date' => $responseBody['data']['created_at'],
                'amount' => $responseBody['data']['amount'],
                'status' => $responseBody['data']['status'],
                'currency_id' => Auth::user()->currency->id,
                'reference' => $responseBody['data']['id'],
                'trxref' => $tx_ref,
                'type' => $type
            ]);


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
            if ($type == "rented") {
                # code...
                //Rent duration is 2 days
                $date_rented_expired = Carbon::now()->addDays(2);
                // $rent_pending = MaterialHistory::where(['user_id' => Auth::user()->id, 'type' => 'rented', 'is_rent_expired' => false])->where('rent_count', '<', 2)->latest()->first();;
                // if ($rent_pending) {
                //     MaterialHistory::where(['user_id' => Auth::user()->id, 'type' => 'rented', 'is_rent_expired' => false, 'id' => $rent_pending->id, 'rent_unique_id' => $rent_pending->rent_unique_id])->update(['rent_count' => 2]);
                //     $rent_count = 2;
                //     $rent_unique_id = $rent_pending->rent_unique_id;
                // } else {
                $rent_count = 1;
                $rent_unique_id = Str::upper("TRX" . $this->unique_code(17));
                // }
            }

            if ($type == "folder") {
                $type = "bought";
                $mat_type = "folder";
                $folder_id = $mat_id;
                $folder = Folder::find($folder_id);
                $mat_id = null;
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
            }

            $data['invoice_id'] = $invoice_id = Str::upper("TRX" . $this->unique_code(12));
            $data['date'] = $date = Carbon::now();



            $my_materials_arr = [];
            $my_materials = MaterialHistory::where(['user_id' => Auth::user()->id, 'is_rent_expired' => false])->get('material_id');
            foreach ($my_materials as $key => $value) {
                # code...
                array_push($my_materials_arr, $value->material_id);
            }

            MaterialHistory::create([
                'user_id' => Auth::user()->id,
                'material_id' => $mat_id,
                'folder_id' => $folder_id,
                'transaction_id' => $trans->id,
                'invoice_id' => $invoice_id,
                'unique_id' => Str::upper("MATHIS" . $this->unique_code(12)),
                'rent_count' => $rent_count,
                'rent_unique_id' => $rent_unique_id,
                'date_rented_expired' => $date_rented_expired ?? null,
                'type' => $type,
                'folder_expired_date' => $folder_expired_date ?? null,
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
}