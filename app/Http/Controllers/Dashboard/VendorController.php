<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\Country;
use App\Models\File;
use App\Models\Folder;
use App\Models\Material;
use App\Models\MaterialHistory;
use App\Models\MaterialType;
use App\Models\Messages;
use App\Models\SubHistory;
use App\Models\Subject;
use App\Models\Subscription;
use App\Models\Transaction;
use App\Models\University;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Image;

class VendorController extends Controller
{

    public function __construct()
    {
    }

    private function unique_code($limit)
    {
        return substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $limit);
    }

    public function index()
    {
        # code...
        try {
            //code...
            $data['title'] = "Vendor Dashboard - My Library";
            $role = ['vendor'];
            $data['material_types'] = MaterialType::where("status", "active")->whereJsonContains('role', $role)->get();
            // $data['materialss'] = $m = Material::where('user_id', Auth::user()->id)->OrderBy('material_type_id')->selectRaw('material_type_id, count(*) as total')->groupBy('material_type_id')->get();
            $data['all_materials'] = $m = Material::where('user_id', Auth::user()->id)->with(['type', 'folder'])->get();

            if ($_GET) {
                if (isset($_GET['mat_unique_id'])) {
                    $mat_unique_id = $_GET['mat_unique_id'];
                    if (
                        $mat_unique_id !== "all" && !empty($mat_unique_id)
                    ) {
                        $data['mt'] = $mt = MaterialType::where('mat_unique_id', $mat_unique_id)->first();
                        $data['all_materials'] = $m = Material::where(['user_id' => Auth::user()->id, 'material_type_id' => $mt->id])->with(['type', 'folder'])->get();
                    }
                }
            }
            // $grp = $m->groupBy('material_type_id');
            // foreach ($grp as $key => $value) {
            //     # code...
            //     dd($value[0]->type->name);
            //     foreach ($value as $key => $value) {
            //         # code...
            //         dd($key, $value);
            //     }
            // }
            // dd($grp);
            // $data['materialss'] = $m = Material::where('user_id', Auth::user()->id)->with(['type', 'file', 'cover', 'country', 'folder', 'subject'])->get();
            // dd($m);
            return View('dashboard.vendor.library', $data);
        } catch (\Throwable $th) {
            //throw $th;
            dd($th->getMessage());
        }
    }

    public function transactions()
    {
        # code...
        try {
            //code...
            $data['title'] = "Vendor Dashboard - Transactions";
            $data['sn'] = 1;
            $matHis = MaterialHistory::with(['trans', 'mat'])->get();
            $mats_arr3 = [];

            foreach ($matHis as $key => $mat_h) {
                # code...
                if (isset($mat_h->mat->user_id)) {
                    if ($mat_h->mat->user_id == Auth::user()->id && $mat_h->transaction_id != null) {
                        array_push($mats_arr3, $mat_h->transaction_id);
                    }
                }
            }

            $data['transactions'] = Transaction::whereIn('id', $mats_arr3)->with('mat_his')->orderBy('created_at', 'DESC')->get();
            // $data['transactions'] = $mats_arr2;
            // dd($data['transactions']);
            return View('dashboard.vendor.transactions', $data);
        } catch (\Throwable $th) {
            //throw $th;
            dd($th);
        }
    }

    public function payouts()
    {
        # code...
        try {
            //code...
            $data['title'] = "Vendor Dashboard - Payouts";
            $data['sn'] = 1;
            return View('dashboard.vendor.payouts', $data);
        } catch (\Throwable $th) {
            //throw $th;
            dd($th);
        }
    }

    public function summary($id)
    {
        # code...
        try {
            //code...
            $data['title'] = "Vendor Dashboard - My Library";
            $data['transactions'] = $this->materials;
            return View('dashboard.vendor.material-summary', $data);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function view_material($id)
    {
        function countPages($path)
        {
            $pdftext = file_get_contents($path);
            $num = preg_match_all("/\/Page\W/", $pdftext, $dummy);
            return $num;
        }
        # code...
        try {
            //code...
            $data['title'] = "Vendor Dashboard - My Library";
            $data['material'] = $m = Material::where(['user_id' => Auth::user()->id, 'id' => $id])->with(['type', 'file', 'cover', 'country', 'folder', 'subject', 'test_country', 'university'])->first();
            // dd($m);
            if (!$m) {
                # code...
                Session::flash('warning', "No material found");
                return back();
            }
            $data['totalRented'] = MaterialHistory::where(['material_id' => $m->id, 'type' => 'rented'])->get()->count();
            $data['totalBought'] = MaterialHistory::where(['material_id' => $m->id, 'type' => 'bought'])->get()->count();
            $data['pageCount'] = countPages(public_path($m->file->url));
            return View('dashboard.vendor.view', $data);
        } catch (\Throwable $th) {
            //throw $th;
            dd($th->getMessage());
        }
    }

    public function help(Request $request)
    {
        # code...
        if ($_POST) {

            $msg_file = null;
            $isMedia = false;

            if ($request->hasFile('save_file')) {
                $msg_file = $request->file('save_file');
                $msg_org_name = $request->file('save_file')->getClientOriginalName();
                $msg_file_name = 'MSGFile' . time() . '.' . $msg_file->getClientOriginalExtension();
                Storage::disk('msg_file')->put($msg_file_name, file_get_contents($msg_file));
                $isMedia = true;
                $save_cover = File::create([
                    'name' => $msg_file_name,
                    'url' => 'storage/message_file/' . $msg_file_name
                ]);
            }

            Messages::create([
                'user_id' => Auth::user()->id,
                'type' => 'user',
                'msg' => $request->msg ?? null,
                'file_name' => $msg_org_name ?? null,
                'isMedia' => $isMedia,
                'media_id' => $save_cover->id ?? null
            ]);

            $data = [
                // 'msg_file' => $msg_file,
                // 'msg_org_name' => $msg_org_name,
                // 'msg_file_name' => $msg_file_name,
                // 'save_cover' => $save_cover,
                'isMedia' => $isMedia,
            ];

            return $data;
        }
        try {
            //code...
            $data['title'] = "Vendor Dashboard - Help";
            $data['messages'] = Messages::where('user_id', Auth::user()->id)->with(['file', 'user', 'admin'])->orderBy('created_at', 'ASC')->get();
            $data['email'] = "virtuallawlibrary@gmail.com";
            return View('dashboard.vendor.help', $data);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function settings(Request $request)
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
                    'bank_id' => ['nullable', 'string', 'max:255'],
                    'acc_number' => ['nullable', 'string', 'max:255'],
                    'acc_name' => ['nullable', 'string', 'max:255'],
                    'avatar' => ['nullable', 'max:5000']
                );

                $validator = Validator::make($request->all(), $rules);

                if ($validator->fails()) {
                    dd($validator->errors());
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
                    'bank_id' => $request->bank_id ?? Auth::user()->bank_id,
                    'acc_number' => $request->acc_number ?? Auth::user()->acc_number,
                    'acc_name' => $request->acc_name ?? Auth::user()->acc_name,
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
                return back();
            }

            $data['banks'] = $b = Bank::orderBy('name', 'ASC')->get(['id', 'name', 'code']);
            $data['sub'] = SubHistory::where('id', Auth::user()->sub_id)->with('sub')->first();
            $data['title'] = "Vendor Dashboard - Settings";
            return View('dashboard.vendor.settings', $data);
        } catch (\Throwable $th) {
            //throw $th;
            dd($th->getMessage());
        }
    }

    public function subscriptions()
    {
        # code...
        try {
            //code...
            $data['title'] = "Subsciptions";
            $data['subs'] = Subscription::where('type', 'professional')->get();
            return View('dashboard.vendor.subscriptions', $data);
        } catch (\Throwable $th) {
            dD($th->getMessage());
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

            // dd($data);
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
                'date' => $date,
                'amount' => $amount,
                'status' => $status,
                'reference' => $reference,
                'trxref' => $trxref,
                'type' => 'subscription'
            ]);
            User::where('id', Auth::user()->id)->update(['sub_id' => $save_sub->id]);
            return $data;
        } catch (\Throwable $th) {
            //throw $th;
            return $th->getMessage();
        }
    }

    public function verifyBank(Request $request)
    {
        try {
            # code...
            $curl = curl_init();

            $type = $request->type;
            $bank = $request->bank;
            $account_number = $request->account_number;
            $bank_code = $request->bank_code;

            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api.paystack.co/bank/resolve?account_number=" . $account_number . "&bank_code=" . $bank_code,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                    "Authorization: Bearer sk_test_7b18d8f604efdd23697fb0d9b53dd76fe9423841",
                    "Cache-Control: no-cache",
                ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
                return json_decode($err, true);
            } else {
                $response = json_decode($response);
                if ($response->status) {
                    if ($type == "NGN") {
                        User::where('id', Auth::user()->id)->update([
                            'bank_id' => $bank,
                            'acc_number' => $account_number,
                            'acc_name' => $response->data->account_name,
                            'acc_verified' => true
                        ]);
                    }
                    if ($type == "USD") {
                        User::where('id', Auth::user()->id)->update([
                            'dom_bank_id' => $bank,
                            'dom_acc_number' => $account_number,
                            'dom_acc_name' => $response->data->account_name,
                            'dom_acc_verified' => true
                        ]);
                    }
                }
                return $response;
            }
        } catch (\Throwable $th) {
            return $th;
            //throw $th;
        }
    }

    public function upload(Request $request)
    {
        # code...
        try {
            //code...
            $data['mode'] = "create";
            if ($_POST) {

                if ($request->folder_id == "new_folder") {
                    $rules = array(
                        'material_type_id' => ['required', 'string', 'max:255'],
                        'folder_id' => ['required', 'string', 'max:255'],
                        'folder_name' => ['required', 'string', 'max:255', 'unique:folders,name'],
                        'name_of_author' => ['required', 'string', 'max:255'],
                        'version' => ['required', 'string', 'max:255'],
                        'country_id' => ['required', 'string', 'max:255'],
                        'price' => ['required', 'string', 'max:255'],
                        'amount' => ['required_if:price,Paid'],
                        'duration' => ['required_if:price,Paid'],
                        'publisher' => ['required', 'string', 'max:255'],
                        'tags' => ['required', 'string', 'max:255'],
                        'folder_cover_id' => ['required', 'mimes:jpeg,png,jpg,gif,svg', 'max:5000'],
                    );
                } elseif ($request->folder_id != null && $request->folder_id != "new_folder") {
                    // dd($request->all());
                    $rules = array(
                        // 'material_type_id' => ['required', 'string', 'max:255'],
                        'folder_id' => ['required', 'string', 'max:255'],
                        'citation' => ['required', 'string', 'max:255'],
                        'name_of_party' => ['required', 'string', 'max:255'],
                        // 'name_of_author' => ['required', 'string', 'max:255'],
                        'name_of_court' => ['required', 'string', 'max:255'],
                        'tags' => ['required', 'string', 'max:255'],
                        'material_file_id' => ['required', 'mimes:pdf,mp4,mov,ogg,qt', 'max:50000'],
                    );
                } else {
                    // dd("not new_folder", $request->all());
                    $rules = array(
                        'title' => ['required', 'string', 'max:255'],
                        // 'name_of_author' => ['required', 'string', 'max:255'],
                        'name_of_author' => ['required_if:material_type_value,TXT,LOJ,VAA'],
                        'version' => ['required_if:material_type_value,TXT,LOJ,VAA'],
                        // 'version' => ['required', 'string', 'max:255'],
                        'year_of_publication' => ['required_if:material_type_value,TXT,LOJ,TAA,VAA'],
                        'price' => ['required_if:material_type_value,TXT,LOJ,TAA,VAA'],
                        'amount' => ['required_if:price,Paid'],
                        'material_type_id' => ['required', 'max:255'],
                        'folder_id' => ['required_if:material_type_value,CSL'],
                        'name_of_party' => ['required_if:material_type_value,CSL'],
                        // 'name_of_court' => ['required_if:material_type_value,CSL'],
                        'citation' => ['required_if:material_type_value,CSL'],
                        // 'year_of_publication' => ['required_if:material_type_value,TXT,LOJ,CSL,VAA'],
                        'country_id' => ['required_if:material_type_value,TXT,LOJ,CSL,VAA'],
                        'test_country_id' => ['required_if:material_type_value,TAA'],
                        'university_id' => ['required_if:material_type_value,TAA'],
                        // 'publisher' => ['required', 'string', 'max:255'],
                        'publisher' => ['required_if:material_type_value,TXT,LOJ,VAA'],
                        'tags' => ['required', 'string', 'max:255'],
                        'subject_id' => ['required_if:material_type_value,TXT'],
                        'privacy_code' => ['required_if:material_type_value,TAA'],
                        'material_file_id' => ['required', 'mimes:pdf,mp4,mp3,mov,ogg,qt', 'max:50000'],
                        'material_cover_id' => ['required_if:material_type_value,TXT,LOJ,VAA', 'mimes:jpeg,png,jpg,gif,svg', 'max:5000'],
                        'material_desc' => ['required_if:material_type_value,TXT,LOJ,VAA'],
                        'terms' => ['required', 'max:255']
                    );
                }

                $messages = [
                    'publisher.required_if' => __('Publisher is required'),
                    'name_of_party.required_if' => __('Name of Party is required'),
                    'name_of_author.required_if' => __('Name of Author is required'),
                    'name_of_court.required_if' => __('Name of Court is required'),
                    'citation.required_if' => __('Citation is required'),
                    'privacy_code.required_if' => __('Test privacy code is required'),
                    'amount.required_if' => __('Amount is required'),
                    'year_of_publication.required_if' => __('Year of Publication is required'),
                    'country_id.required_if' => __('Country of Publication is required'),
                    'test_country_id.required_if' => __('Country is required'),
                    'university_id.required_if' => __('The University is required'),
                    'material_type_id.required' => __('The Material Type is required'),
                    'country_id.required' => __('Country of Publication is required'),
                    'subject_id.required' => __('The Subject name is required'),
                    'folder_id.required_if' => __('The Folder name is required'),
                    'material_file_id.required' => __('The Material File is required'),
                    'material_file_id.required_if' => __('The Material File is required'),
                    'material_file_id.max' => __('The Material File size must not more than 50MB'),
                    'material_cover_id.required_if' => __('The Material Cover is required'),
                    'material_cover_id.max' => __('The Material Cover size must not more that 5MB')
                ];

                $validator = Validator::make($request->all(), $rules, $messages);

                if ($validator->fails()) {
                    // dd($request->all(), $validator->errors());
                    Session::flash('warning', __('All fields are required'));
                    return back()->withErrors($validator)->withInput();
                }

                $tags = explode(",", $request->tags);

                if ($request->hasFile('material_file_id')) {
                    $material_file = $request->file('material_file_id');
                    $material_file_name = 'MaterialFile' . time() . '.' . $material_file->getClientOriginalExtension();
                    Storage::disk('material_file')->put($material_file_name, file_get_contents($material_file));
                    $save_file = File::create([
                        'name' => $material_file_name,
                        'url' => 'storage/materials/files/' . $material_file_name
                    ]);
                }

                // if ($request->hasFile('material_cover_id')) {
                //     $material_cover = $request->file('material_cover_id');
                //     $material_cover_name = 'MaterialCover' . time() . '.' . $material_cover->getClientOriginalExtension();
                //     Storage::disk('material_cover')->put($material_cover_name, file_get_contents($material_cover));
                //     $save_cover = File::create([
                //         'name' => $material_cover_name,
                //         'url' => 'storage/materials/covers/' . $material_cover_name
                //     ]);
                // }
                if ($request->hasFile('material_cover_id')) {
                    $material_cover = $request->file('material_cover_id');
                    $material_cover_name = 'MaterialCover' . time() . '.' . $material_cover->getClientOriginalExtension();
                    $destinationPath = public_path('/storage/materials/covers');
                    $img = Image::make($material_cover->path());
                    $img->resize(600, 300, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($destinationPath . '/' . $material_cover_name);
                    $save_cover = File::create([
                        'name' => $material_cover_name,
                        'url' => 'storage/materials/covers/' . $material_cover_name
                    ]);
                }

                if ($request->hasFile('folder_cover_id')) {
                    $folder_cover = $request->file('folder_cover_id');
                    $folder_cover_name = 'FolderCover' . time() . '.' . $folder_cover->getClientOriginalExtension();
                    $destinationPath = public_path('/storage/materials/covers');
                    $img = Image::make($folder_cover->path());
                    $img->resize(600, 300, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($destinationPath . '/' . $folder_cover_name);
                    $save_folder_cover = File::create([
                        'name' => $folder_cover_name,
                        'url' => 'storage/materials/covers/' . $folder_cover_name
                    ]);
                }
                if ($request->folder_id == "new_folder") {
                    $new_foler = Folder::create([
                        "material_type_id" => $request->material_type_id,
                        "name" => $request->folder_name,
                        "amount" => $request->amount ?? 0,
                        "duration" => $request->duration ?? 'free',
                        "publisher" => $request->publisher,
                        "name_of_author" => $request->name_of_author,
                        "version" => $request->version,
                        "price" => $request->price,
                        "currency_id" => $request->currency_id ?? null,
                        "tags" => $tags,
                        "country_id" => $request->country_id,
                        "folder_cover_id" => $save_folder_cover->id,
                        "user_id" => Auth::user()->id
                    ]);
                    $mat_type = MaterialType::find($request->material_type_id);
                    $mat_unique = substr($mat_type->mat_unique_id, 0, 3);
                    Session::flash('success', __('New Folder created successfully'));
                    Session::put('new_folder', $new_foler);
                    Session::put('mat_type', $mat_type);
                    Session::put('mat_unique', $mat_unique);
                    return redirect()->back();
                } else {

                    $folder = null;
                    if ($request->material_type_value == "CSL") {
                        $folder = Folder::find($request->folder_id);
                        // dd($request->all(), $folder);
                    }

                    Material::create([
                        'user_id' => Auth::user()->id,
                        'title' => $request->title ?? null,
                        'currency_id' => $request->currency_id ?? Auth::user()->currency->id,
                        'name_of_author' => $request->name_of_author ?? null,
                        'name_of_court' => $request->name_of_court ?? null,
                        'name_of_party' => $request->name_of_party ?? null,
                        'citation' => $request->citation ?? null,
                        "currency_id" => $request->currency_id ?? null,
                        'version' => $request->version ?? null,
                        'price' => $request->price ?? null,
                        'amount' => $request->amount ?? null,
                        'material_type_id' => $request->material_type_id ?? $folder->material_type_id,
                        'folder_id' => $request->folder_id ?? null,
                        'year_of_publication' => $request->year_of_publication ?? null,
                        'test_country_id' => $request->test_country_id ?? null,
                        'university_id' => $request->university_id ?? null,
                        'country_id' => $request->country_id ?? null,
                        'publisher' => $request->publisher ?? null,
                        'tags' => $tags,
                        'uploaded_by' => 'vendor',
                        'subject_id' => $request->subject_id ?? null,
                        'privacy_code' => $request->privacy_code ?? null,
                        'material_file_id' => $save_file->id ?? null,
                        'material_cover_id' => $save_cover->id ?? $folder->folder_cover_id,
                        'material_desc' => $request->material_desc ?? null
                    ]);

                    Session::forget('new_folder');
                    Session::forget('mat_type');
                    Session::forget('mat_unique');
                    Session::flash('success', 'Material uploaded successfully');
                    return redirect()->route('vendor.index');
                }
            }

            $data['title'] = "Vendor Dashboard - Upload Material";
            $role = ['vendor'];
            $data['ff_csl'] = false;
            $data['ff_law'] = false;
            $data['folders'] = $f = Folder::where(['user_id' => Auth::user()->id])->with('mat_type')->get();
            foreach ($f as $key => $value) {
                # code...
                if (isset($value->mat_type->mat_unique_id)) {
                    if (
                        substr($value->mat_type->mat_unique_id, 0, 3) == "CSL"
                    ) {
                        $data['ff_csl'] = true;
                    }
                    if (
                        substr($value->mat_type->mat_unique_id, 0, 3) == "LAW"
                    ) {
                        $data['ff_law'] = true;
                    }
                }
            }
            $data['material_types'] = $m = MaterialType::where("status", "active")->whereJsonContains('role', $role)->get();
            $data['subjects'] = Subject::where("status", "active")->get();
            $data['countries'] = Country::all();
            $material_type_id = MaterialType::where(["status" => "active", "mat_unique_id" => "CSL786746357"])->whereJsonContains('role', $role)->get();
            $data['material_type_id'] = $mat_id = $material_type_id[0]['id'];
            $data['folders'] = $f = Folder::where(['user_id' => Auth::user()->id, 'material_type_id' => $mat_id])->get();
            $data['universities'] = University::Orderby('name', 'ASC')->get();
            return View('dashboard.vendor.upload', $data);
        } catch (\Throwable $th) {
            dD($th->getMessage());
            //throw $th;
        }
    }

    public function edit(Request $request, $id)
    {
        # code...
        try {
            //code...
            $data['mode'] = "edit";
            if ($_POST) {
                $material = Material::find($request->id);
                if (!$material) {
                    Session::flash('warning', 'No record found for this material');
                    return redirect()->back();
                }

                // dd("not new_folder", $request->all());
                if ($request->folder_id == "new_folder") {
                    $rules = array(
                        'material_type_id' => ['required', 'string', 'max:255'],
                        'folder_id' => ['required', 'string', 'max:255'],
                        'folder_name' => ['required', 'string', 'max:255'],
                        'name_of_author' => ['required', 'string', 'max:255'],
                        'version' => ['required', 'string', 'max:255'],
                        'country_id' => ['required', 'string', 'max:255'],
                        'price' => ['required', 'string', 'max:255'],
                        'amount' => ['required_if:price,Paid'],
                        'publisher' => ['required', 'string', 'max:255'],
                        'tags' => ['required', 'string', 'max:255'],
                        'folder_cover_id' => ['required', 'mimes:jpeg,png,jpg,gif,svg', 'max:5000'],
                    );
                } elseif ($request->folder_id != null && $request->folder_id != "new_folder") {
                    $rules = array(
                        // 'material_type_id' => ['required', 'string', 'max:255'],
                        'folder_id' => ['required', 'string', 'max:255'],
                        'citation' => ['required', 'string', 'max:255'],
                        'name_of_party' => ['required', 'string', 'max:255'],
                        // 'name_of_author' => ['required', 'string', 'max:255'],
                        'name_of_court' => ['required', 'string', 'max:255'],
                        'tags' => ['required', 'string', 'max:255'],
                        'material_file_id' => ['mimes:pdf,mp4,mov,ogg,qt', 'max:50000'],
                    );
                } else {
                    $rules = array(
                        'title' => ['required', 'string', 'max:255'],
                        // 'name_of_author' => ['required', 'string', 'max:255'],
                        'name_of_author' => ['required_if:material_type_value,TXT,LOJ,VAA'],
                        'version' => ['required_if:material_type_value,TXT,LOJ,VAA'],
                        // 'version' => ['required', 'string', 'max:255'],
                        'year_of_publication' => ['required_if:material_type_value,TXT,LOJ,TAA,VAA'],
                        'price' => ['required_if:material_type_value,TXT,LOJ,TAA,VAA'],
                        'amount' => ['required_if:price,Paid'],
                        'material_type_id' => ['required', 'max:255'],
                        'folder_id' => ['required_if:material_type_value,CSL'],
                        'name_of_party' => ['required_if:material_type_value,CSL'],
                        // 'name_of_court' => ['required_if:material_type_value,CSL'],
                        'citation' => ['required_if:material_type_value,CSL'],
                        // 'year_of_publication' => ['required_if:material_type_value,TXT,LOJ,CSL,VAA'],
                        'country_id' => ['required_if:material_type_value,TXT,LOJ,CSL,VAA'],
                        'test_country_id' => ['required_if:material_type_value,TAA'],
                        'university_id' => ['required_if:material_type_value,TAA'],
                        // 'publisher' => ['required', 'string', 'max:255'],
                        'publisher' => ['required_if:material_type_value,TXT,LOJ,VAA'],
                        'tags' => ['required', 'string', 'max:255'],
                        'subject_id' => ['required_if:material_type_value,TXT'],
                        'privacy_code' => ['required_if:material_type_value,TAA'],
                        'material_file_id' => ['mimes:pdf,mp4,mp3,mov,ogg,qt', 'max:50000'],
                        'material_cover_id' => ['mimes:jpeg,png,jpg,gif,svg', 'max:5000'],
                        'material_desc' => ['required_if:material_type_value,TXT,LOJ,VAA'],
                    );
                }

                $messages = [
                    'publisher.required_if' => __('Publisher is required'),
                    'name_of_party.required_if' => __('Name of Party is required'),
                    'name_of_author.required_if' => __('Name of Author is required'),
                    'name_of_court.required_if' => __('Name of Court is required'),
                    'citation.required_if' => __('Citation is required'),
                    'privacy_code.required_if' => __('Test privacy code is required'),
                    'amount.required_if' => __('Amount is required'),
                    'year_of_publication.required_if' => __('Year of Publication is required'),
                    'country_id.required_if' => __('Country of Publication is required'),
                    'test_country_id.required_if' => __('Country is required'),
                    'university_id.required_if' => __('The University is required'),
                    'material_type_id.required' => __('The Material Type is required'),
                    'country_id.required' => __('Country of Publication is required'),
                    'subject_id.required' => __('The Subject name is required'),
                    'folder_id.required_if' => __('The Folder name is required'),
                    'material_file_id.required' => __('The Material File is required'),
                    'material_file_id.required_if' => __('The Material File is required'),
                    'material_file_id.max' => __('The Material File size must not more than 50MB'),
                    'material_cover_id.required_if' => __('The Material Cover is required'),
                    'material_cover_id.max' => __('The Material Cover size must not more that 5MB')
                ];


                $validator = Validator::make($request->all(), $rules, $messages);

                if ($validator->fails()) {
                    dd($validator->errors());
                    Session::flash('warning', __('All fields are required'));
                    return back()->withErrors($validator)->withInput();
                }

                $tags = explode(",", $request->tags);

                if ($request->hasFile('material_file_id')) {
                    $material_file = $request->file('material_file_id');
                    $material_file_name = 'MaterialFile' . time() . '.' . $material_file->getClientOriginalExtension();
                    Storage::disk('material_file')->put($material_file_name, file_get_contents($material_file));
                    $save_file = File::create([
                        'name' => $material_file_name,
                        'url' => 'storage/materials/files/' . $material_file_name
                    ]);
                }

                // if ($request->hasFile('material_cover_id')) {
                //     $material_cover = $request->file('material_cover_id');
                //     $material_cover_name = 'MaterialCover' . time() . '.' . $material_cover->getClientOriginalExtension();
                //     Storage::disk('material_cover')->put($material_cover_name, file_get_contents($material_cover));
                //     $save_cover = File::create([
                //         'name' => $material_cover_name,
                //         'url' => 'storage/materials/covers/' . $material_cover_name
                //     ]);
                // }
                if ($request->hasFile('material_cover_id')) {
                    $material_cover = $request->file('material_cover_id');
                    $material_cover_name = 'MaterialCover' . time() . '.' . $material_cover->getClientOriginalExtension();
                    $destinationPath = public_path('/storage/materials/covers');
                    $img = Image::make($material_cover->path());
                    $img->resize(600, 300, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($destinationPath . '/' . $material_cover_name);
                    $save_cover = File::create([
                        'name' => $material_cover_name,
                        'url' => 'storage/materials/covers/' . $material_cover_name
                    ]);
                }

                Material::where(['user_id' => Auth::user()->id, 'id' => $request->id])->update([
                    'user_id' => Auth::user()->id,
                    'title' => $request->title ?? $material['title'],
                    'currency_id' => $request->currency_id ?? $material['currency_id'],
                    'name_of_author' => $request->name_of_author ?? $material['name_of_author'],
                    'name_of_party' => $request->name_of_party ?? $material['name_of_party'],
                    'name_of_court' => $request->name_of_court ?? $material['name_of_court'],
                    'citation' => $request->citation ?? $material['citation'],
                    'version' => $request->version ?? $material['version'],
                    'price' => $request->price ?? $material['price'],
                    'amount' => $request->amount ?? $material['amount'],
                    'currency_id' => $request->currency_id ?? $material['currency_id'],
                    'material_type_id' => $request->material_type_id ?? $material['material_type_id'],
                    'folder_id' => $request->folder_id ?? $material['folder_id'],
                    'year_of_publication' => $request->year_of_publication ?? $material['year_of_publication'],
                    'country_id' => $request->country_id ?? $material['country_id'],
                    'test_country_id' => $request->test_country_id ?? $material['test_country_id'],
                    'university_id' => $request->university_id ?? $material['university_id'],
                    'publisher' => $request->publisher ?? $material['publisher'],
                    'tags' => $tags ?? $material['tags'],
                    'subject_id' => $request->subject_id ?? $material['subject_id'],
                    'privacy_code' => $request->privacy_code ?? $material['privacy_code'],
                    'material_file_id' => $save_file->id ?? $material['material_file_id'],
                    'material_cover_id' => $save_cover->id ?? $material['material_cover_id'],
                    'material_desc' => $request->material_desc ?? $material['material_desc']
                ]);

                Session::flash('success', 'Material updated successfully');
                return redirect()->route('vendor.index');
            }

            $data['material'] = $material = Material::where(['user_id' => Auth::user()->id, 'id' => $id])->with('type')->first();
            if ($material->count() == 0) {
                Session::flash('warning', 'No record found');
                return redirect()->route('vendor.index');
            }
            $data['title'] = "Vendor Dashboard - Edit Material";
            $role = ['vendor'];
            $data['ff_csl'] = false;
            $data['ff_law'] = false;
            $data['folders'] = $f = Folder::where(['user_id' => Auth::user()->id])->with('mat_type')->get();
            foreach ($f as $key => $value) {
                # code...
                if (isset($value->mat_type->mat_unique_id)) {
                    if (
                        substr($value->mat_type->mat_unique_id, 0, 3) == "CSL"
                    ) {
                        $data['ff_csl'] = true;
                    }
                    if (
                        substr($value->mat_type->mat_unique_id, 0, 3) == "LAW"
                    ) {
                        $data['ff_law'] = true;
                    }
                }
            }
            $data['material_types'] = MaterialType::where("status", "active")->whereJsonContains('role', $role)->get();
            $data['subjects'] = Subject::where("status", "active")->get();
            $data['countries'] = Country::all();
            $material_type_id = MaterialType::where(["status" => "active", "mat_unique_id" => "CSL786746357"])->whereJsonContains('role', $role)->get();
            $data['material_type_id'] = $mat_id = $material_type_id[0]['id'];
            $data['folders'] = $f = Folder::where(['user_id' => Auth::user()->id, 'material_type_id' => $mat_id])->get();
            $data['universities'] = University::Orderby('name', 'ASC')->get();
            return View('dashboard.vendor.edit', $data);
        } catch (\Throwable $th) {
            dD($th->getMessage());
            //throw $th;
        }
    }

    public function cancel()
    {
        # code...
        try {
            //code...
            Session::forget('new_folder');
            Session::forget('mat_type');
            Session::forget('mat_unique');
            Session::flash('success', __('Upload Canceled'));
            return redirect()->route('vendor.index');
        } catch (\Throwable $th) {
            dd($th->getMessage());
            //throw $th;
        }
    }

    public function delete($id)
    {
        # code...
        try {
            //code...
            $material = Material::find($id);
            if (!$material) {
                Session::flash('warning', 'No record found for this material');
                return redirect()->back();
            }
            $material->delete();
            Session::flash('success', 'Material deleted successfully');
            return redirect()->route('vendor.index');
        } catch (\Throwable $th) {
            dD($th->getMessage());
            //throw $th;
        }
    }

    public function folders()
    {
        # code...
        try {
            //code...
            $data['title'] = "Vendor Dashboard - All Folder";
            $data['sn'] = 1;
            $data['folders'] = $f = Folder::where(['user_id' => Auth::user()->id])->with('mat_type')->get();
            return View('dashboard.vendor.folders', $data);
        } catch (\Throwable $th) {
            dD($th->getMessage());
            //throw $th;
        }
    }

    public function add_folder(Request $request)
    {
        # code...
        try {
            //code...
            if ($_POST) {
                $rules = array(
                    'name' => ['required', 'string', 'max:255'],
                    'amount' => ['required', 'string'],
                    'folder_cover_id' => ['required', 'mimes:jpeg,png,jpg,gif,svg', 'max:50000'],
                );

                $messages = [
                    'folder_cover_id.required_if' => __('The Folder cover is required'),
                ];

                $validator = Validator::make($request->all(), $rules, $messages);

                if ($validator->fails()) {
                    Session::flash('warning', __('All fields are required'));
                    return back()->withErrors($validator)->withInput();
                }

                if ($request->hasFile('folder_cover_id')) {
                    $folder_cover = $request->file('folder_cover_id');
                    $folder_cover_name = 'FolderCover' . time() . '.' . $folder_cover->getClientOriginalExtension();
                    $destinationPath = public_path('/storage/materials/covers');
                    $img = Image::make($folder_cover->path());
                    $img->resize(600, 300, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($destinationPath . '/' . $folder_cover_name);
                    $save_cover = File::create([
                        'name' => $folder_cover_name,
                        'url' => 'storage/materials/covers/' . $folder_cover_name
                    ]);
                }


                $tags = explode(",", $request->tags);

                // dd($request->all());


                Folder::create([
                    "material_type_id" => $request->material_type_id,
                    "name" => $request->name,
                    "name_of_author" => $request->name_of_author,
                    "version" => $request->version,
                    "country_id" => $request->country_id,
                    "publisher" => $request->publisher,
                    "tags" => $tags,
                    "amount" => $request->amount,
                    "folder_cover_id" => $save_cover->id,
                ]);
                Session::flash('success', __('Folder added successfully'));
                return redirect()->back();
            }

            $data['title'] = "Vendor Dashboard - Create New Folder";
            $role = ['vendor'];
            $data['mode'] = "create";
            $data['material_types'] = $m = MaterialType::where("status", "active")->whereJsonContains('role', $role)->get();
            $material_type_id = MaterialType::where(["status" => "active", "mat_unique_id" => "CSL786746357"])->whereJsonContains('role', $role)->get();
            $data['subjects'] = Subject::where("status", "active")->get();
            $data['countries'] = Country::all();
            $data['material_type_id'] = $mat_id = $material_type_id[0]['id'];
            $data['folders'] = $f = Folder::where(['user_id' => Auth::user()->id, 'material_type_id' => $mat_id])->get();
            return View('dashboard.vendor.add-material-folder', $data);
        } catch (\Throwable $th) {
            dD($th->getMessage());
            //throw $th;
        }
    }

    public function delete_folder($id)
    {
        # code...
        try {
            //code...
            $folder = Folder::where(['user_id' => Auth::user()->id, 'id' => $id])->first();
            if (!$folder) {
                Session::flash('warning', 'No record found for this folder');
                return redirect()->back();
            }
            $folder->delete();
            Session::flash('success', 'Folder deleted successfully');
            return redirect()->route('vendor.folders');
        } catch (\Throwable $th) {
            dD($th->getMessage());
            //throw $th;
        }
    }


    public function edit_folder(Request $request, $id)
    {
        # code...
        try {
            $data['folder'] = $folder = Folder::where(['user_id' => Auth::user()->id, 'id' => $id])->first();

            if (!$folder) {
                Session::flash('warning', __('No record found'));
                return redirect()->route('vendor.folders');
            }
            //code...
            if ($_POST) {
                $rules = array(
                    'name' => ['required', 'string', 'unique:folders,name,' . $id],
                    // 'amount' => ['required', 'string'],
                    'amount' => ['required_if:price,Paid'],
                    'duration' => ['required_if:price,Paid'],
                    'folder_cover_id' => ['mimes:jpeg,png,jpg,gif,svg', 'max:50000'],
                );

                $messages = [
                    'name.unique' => __('The Folder name has already been taken'),
                    'folder_cover_id.required_if' => __('The Folder cover is required'),
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

                if ($request->hasFile('folder_cover_id')) {
                    $folder_cover = $request->file('folder_cover_id');
                    $folder_cover_name = 'FolderCover' . time() . '.' . $folder_cover->getClientOriginalExtension();
                    $destinationPath = public_path('/storage/materials/covers');
                    $img = Image::make($folder_cover->path());
                    $img->resize(600, 300, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($destinationPath . '/' . $folder_cover_name);
                    $save_cover = File::create([
                        'name' => $folder_cover_name,
                        'url' => 'storage/materials/covers/' . $folder_cover_name
                    ]);
                }

                $tags = explode(",", $request->tags);

                // dd($request->all());

                Folder::where(['user_id' => Auth::user()->id, 'id' => $id])->update([
                    "material_type_id" => $request->material_type_id,
                    "name" => $request->name,
                    "name_of_author" => $request->name_of_author,
                    "version" => $request->version,
                    "country_id" => $request->country_id,
                    "currency_id" => $request->currency_id,
                    "publisher" => $request->publisher,
                    "tags" => $tags,
                    "amount" => $request->amount ?? $folder->amount,
                    "duration" => $request->duration ?? $folder->duration,
                    "folder_cover_id" => $save_cover->id ?? $folder->folder_cover_id,
                ]);
                Session::flash('success', __('Folder updated successfully'));
                return redirect()->route('vendor.folders');
            }

            $data['title'] = "Vendor Dashboard - Edit Folder";
            $data['mode'] = "edit";
            $data['countries'] = Country::all();
            return View('dashboard.vendor.add-material-folder', $data);
        } catch (\Throwable $th) {
            dD($th->getMessage());
            //throw $th;
        }
    }

    public function view_folder($id)
    {
        # code...
        try {
            //code...
            $data['sn'] = 1;
            $data['title'] = "Vendor Dashboard - Materials";
            $data['all_materials'] = Material::where(['user_id' => Auth::user()->id, 'folder_id' => $id])->with(['type', 'folder'])->get();
            return View('dashboard.vendor.view-folder', $data);
        } catch (\Throwable $th) {
            //throw $th;
            dd($th->getMessage());
        }
    }
}