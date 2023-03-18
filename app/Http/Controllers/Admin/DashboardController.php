<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\FAQ;
use App\Models\Material;
use App\Models\MaterialHistory;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\File;
use App\Models\MaterialType;
use App\Models\Setting;
use App\Models\Subject;
use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{

    public function index(Request $request)
    {
        # code...
        try {
            //code...
            $data['title'] = "Admin Dashboard";
            $data['user_count'] = User::where('role', 'user')->count();
            $data['vendor_count'] = User::where('role', 'vendor')->count();
            $data['admin_upload'] = Material::where('uploaded_by', 'admin')->count();
            $data['vendor_upload'] = Material::where('uploaded_by', 'vendor')->count();
            $mat_h_r = MaterialHistory::with('trans')->where('type', 'rented')->get();
            $mat_h_b = MaterialHistory::with('trans')->where('type', 'bought')->get();

            if ($_GET) {
                if ($_GET['date'] && $_GET['date'] != 'all') {
                    $days = $_GET['date'] ?? 0;
                    $date = Carbon::now()->subDays($days);
                    if ($days == 12) {
                        $date = Carbon::now()->subMonth(12);
                    }
                    $data['user_count'] = User::where('role', 'user')->where('created_at', '>=', $date)->count();
                    $data['vendor_count'] = User::where('role', 'vendor')->where('created_at', '>=', $date)->count();
                    $data['admin_upload'] = Material::where('uploaded_by', 'admin')->where('created_at', '>=', $date)->count();
                    $data['vendor_upload'] = Material::where('uploaded_by', 'vendor')->where('created_at', '>=', $date)->count();
                    $mat_h_r = MaterialHistory::with('trans')->where('type', 'rented')->where('created_at', '>=', $date)->get();
                    $mat_h_b = MaterialHistory::with('trans')->where('type', 'bought')->where('created_at', '>=', $date)->get();
                }
            }

            $data['rented_amt'] = $mat_h_r->sum('trans.amount');
            $data['rented_count'] = $mat_h_r->count();
            $data['bought_amt'] = $mat_h_b->sum('trans.amount');
            $data['bought_count'] = $mat_h_b->count();

            return View('dashboard.admin.dashboard.index', $data);
        } catch (\Throwable $th) {
            dd($th->getMessage());
            //throw $th;
        }
    }

    public function profile(Request $request)
    {
        # code...
        try {
            //code...

            if ($_POST) {
                $rules = array(
                    'name' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'max:255', 'unique:users,email,' . Auth::user()->id],
                    'gender' => ['string', 'max:255'],
                    'phone' => ['nullable', 'string', 'max:255'],
                    'avatar' => ['nullable', 'max:5000']
                );

                $validator = Validator::make($request->all(), $rules);

                if ($validator->fails()) {
                    // dd($validator->errors());
                    Session::flash('warning', __('All fields are required'));
                    return back()->withErrors($validator)->withInput();
                }

                // dd($request->all());
                if ($request->hasFile('avatar')) {
                    $profile_pics = $request->file('avatar');
                    $profile_pics_name = 'MaterialCover' . time() . '.' . $profile_pics->getClientOriginalExtension();
                    Storage::disk('profile_pics')->put($profile_pics_name, file_get_contents($profile_pics));
                    $save_cover = File::create([
                        'name' => $profile_pics_name,
                        'url' => 'storage/avatars/' . $profile_pics_name
                    ]);
                }

                $update_user = User::where('id', Auth::user()->id)->update([
                    'name' => $request->name ?? Auth::user()->name,
                    'email' => $request->email ?? Auth::user()->email,
                    'gender' => $request->gender ?? Auth::user()->gender,
                    'phone' => $request->phone ?? Auth::user()->phone,
                    'avatar' => $save_cover->id ?? Auth::user()->profile_pics->id,
                ]);

                if (!$update_user) {
                    # code...
                    Session::flash('error', "An error occur when update profile, try again");
                    return back();
                }


                Session::flash('success', "Profile updated successfully");
                return redirect()->route('admin.settings');
            }

            return redirect()->route('admin.settings');
        } catch (\Throwable $th) {
            dd($th->getMessage());
            //throw $th;
        }
    }

    public function sub_admin_profile(Request $request)
    {
        # code...
        try {
            //code...
            if ($_POST) {
                $rules = array(
                    'name' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'max:255', 'unique:users,email,' . Auth::user()->id],
                    'gender' => ['string', 'max:255'],
                    'phone' => ['nullable', 'string', 'max:255'],
                    'avatar' => ['nullable', 'max:5000']
                );

                $validator = Validator::make($request->all(), $rules);

                if ($validator->fails()) {
                    // dd($validator->errors());
                    Session::flash('warning', __('All fields are required'));
                    return back()->withErrors($validator)->withInput();
                }

                // dd($request->all());
                if ($request->hasFile('avatar')) {
                    $profile_pics = $request->file('avatar');
                    $profile_pics_name = 'MaterialCover' . time() . '.' . $profile_pics->getClientOriginalExtension();
                    Storage::disk('profile_pics')->put($profile_pics_name, file_get_contents($profile_pics));
                    $save_cover = File::create([
                        'name' => $profile_pics_name,
                        'url' => 'storage/avatars/' . $profile_pics_name
                    ]);
                }

                $update_user = User::where('id', Auth::user()->id)->update([
                    'name' => $request->name ?? Auth::user()->name,
                    'email' => $request->email ?? Auth::user()->email,
                    'gender' => $request->gender ?? Auth::user()->gender,
                    'phone' => $request->phone ?? Auth::user()->phone,
                    'avatar' => $save_cover->id ?? Auth::user()->profile_pics->id,
                ]);

                if (!$update_user) {
                    # code...
                    Session::flash('error', "An error occur when update profile, try again");
                    return back();
                }


                Session::flash('success', "Profile updated successfully");
                return redirect()->route('admin.sub_admin_profile');
            }

            $data['title'] = "My Profile";
            return View('dashboard.admin.sub-admin.profile', $data);
        } catch (\Throwable $th) {
            dd($th->getMessage());
            //throw $th;
        }
    }

    public function settings(Request $request)
    {

        # code...
        try {
            //code...

            if ($_POST) {
                $params = $request->except('_token');
                foreach ($params as $key => $value) {
                    $settings = Setting::where('key', $key)->first();
                    if (empty($settings)) {
                        $req = array("key" => $key, "value" => $value);
                        Setting::create($req);
                    } else {
                        $settings->value = $value;
                        $settings->save();
                    }
                }
                Cache::flush();
                Session::flash('success', "Settings updated successfully");
                return redirect()->route('admin.settings')->withInput(['tabName' => 'general']);;
            }


            $data['sn'] = 1;
            $data['title'] = "General Settings";
            $data['material_types'] = MaterialType::all();
            $data['material_types_sub'] = MaterialType::where('status', "active")->get();
            $data['subjects'] = Subject::with('material')->get();
            $data['subs'] = Subscription::all();
            $data['faqs'] = FAQ::all();
            return View('dashboard.admin.settings.index', $data);
        } catch (\Throwable $th) {
            dd($th->getMessage());
            //throw $th;
        }
    }


    public function change_currency(Request $request)
    {
        # code...
        try {
            //code...
            $curr_id = $request->curr_id;
            $currency = Currency::find($curr_id);
            if (!$currency) {
                return false;
            }
            User::where('id', Auth::user()->id)->update(['default_currency_id' => $currency->id]);
            Cache::flush();
            return true;
        } catch (\Throwable $th) {
            return $th->getMessage();
            // dd($th->getMessage());
            //throw $th;
        }
    }
}