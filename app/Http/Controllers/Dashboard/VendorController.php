<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\Country;
use App\Models\File;
use App\Models\Folder;
use App\Models\Material;
use App\Models\MaterialType;
use App\Models\Subject;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Image;

class VendorController extends Controller
{

    public function __construct()
    {

        $this->materials = array(
            (object) [
                'id' => 7879,
                'title' => 'Constitutional Law',
                'link' => '#',
                'author' => "Daniel Febrigez",
                'year' => '2002',
                'img' => asset('materials/img/001.png')
            ],
            (object) [
                'id' => 7880,
                'title' => 'Introduction to Business Laws',
                'link' => '#',
                'author' => "Daniel Febrigez",
                'year' => '2002',
                'img' => asset('materials/img/002.png')
            ],
            (object) [
                'id' => 7881,
                'title' => 'Constitutional Law',
                'link' => '#',
                'author' => "Daniel Febrigez",
                'year' => '2002',
                'img' => asset('materials/img/003.png')
            ],
            (object) [
                'id' => 7882,
                'title' => 'Constitutional Law',
                'link' => '#',
                'author' => "Daniel Febrigez",
                'year' => '2002',
                'img' => asset('materials/img/004.png')
            ],
            (object) [
                'id' => 7883,
                'title' => 'Introduction to Business Laws',
                'link' => '#',
                'author' => "Daniel Febrigez",
                'year' => '2002',
                'img' => asset('materials/img/005.png')
            ],
            (object) [
                'id' => 7884,
                'title' => 'Constitutional Law',
                'link' => '#',
                'author' => "Daniel Febrigez",
                'year' => '2002',
                'img' => asset('materials/img/006.png')
            ]
        );
        $this->transactions = array(
            (object) [
                'id' => 7879,
                'type' => 'Subscription',
                'price' => '6700',
                'author' => "Daniel Febrigez",
                'year' => '2002',
                'img' => asset('materials/img/001.png')
            ],
            (object) [
                'id' => 7879,
                'title' => 'Constitutional Law',
                'price' => '6700',
                'author' => "Daniel Febrigez",
                'year' => '2002',
                'img' => asset('materials/img/001.png')
            ],
        );
        $this->videos = array(
            (object) [
                'id' => 7879,
                'title' => 'Law of Counsel(2002)',
                'link' => '#',
                'author' => "Daniel Febrigez",
                'year' => '2002',
                'img' => asset('materials/img/v-001.png')
            ],
            (object) [
                'id' => 7880,
                'title' => 'Law of Counsel(2002)',
                'link' => '#',
                'author' => "Daniel Febrigez",
                'year' => '2002',
                'img' => asset('materials/img/v-002.png')
            ],
            (object) [
                'id' => 7881,
                'title' => 'Law of Counsel(2002)',
                'link' => '#',
                'author' => "Daniel Febrigez",
                'year' => '2002',
                'img' => asset('materials/img/v-003.png')
            ],
            (object) [
                'id' => 7882,
                'title' => 'Law of Counsel(2002)',
                'link' => '#',
                'author' => "Daniel Febrigez",
                'year' => '2002',
                'img' => asset('materials/img/v-004.png')
            ],
        );
    }
    public function index()
    {
        # code...
        try {
            //code...
            $data['title'] = "Vnedor Dashboard - My Library";
            $data['materials'] = $this->materials;
            $data['videos'] = $this->videos;
            $data['materials'] = $this->materials;
            $data['material_types'] = MaterialType::OrderBy('name', 'ASC')->get();
            // $data['materialss'] = $m = Material::where('user_id', Auth::user()->id)->OrderBy('material_type_id')->selectRaw('material_type_id, count(*) as total')->groupBy('material_type_id')->get();
            $data['all_materials'] = $m = Material::where('user_id', Auth::user()->id)->with('type')->get();
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

    public function library()
    {
        # code...
        try {
            //code...
            $data['title'] = "Vnedor Dashboard - My Library";
            $data['materials'] = $this->materials;
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
            $data['title'] = "Vnedor Dashboard - My Library";
            $data['transactions'] = $this->materials;
            return View('dashboard.vendor.transactions', $data);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    // public function view_material($id)
    // {
    //     # code...
    //     try {
    //         //code...
    //         $data['title'] = "Vnedor Dashboard - My Library";
    //         $data['transactions'] = $this->materials;
    //         return View('dashboard.vendor.view-material', $data);
    //     } catch (\Throwable $th) {
    //         //throw $th;
    //     }
    // }
    public function summary($id)
    {
        # code...
        try {
            //code...
            $data['title'] = "Vnedor Dashboard - My Library";
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
            $data['title'] = "Vnedor Dashboard - My Library";
            $data['material'] = $m = Material::where(['user_id' => Auth::user()->id, 'id' => $id])->with(['type', 'file', 'cover', 'country', 'folder', 'subject'])->first();
            // dd($m);
            if (!$m) {
                # code...
                Session::flash('warning', "No material found");
                return back();
            }
            $data['totalRented'] = 0;
            $data['totalBought'] = 0;
            $data['pageCount'] = countPages(public_path($m->file->url));
            return View('dashboard.vendor.view', $data);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function help()
    {
        # code...
        try {
            //code...
            $data['title'] = "Vnedor Dashboard - Help";
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
                    'email' => ['required', 'max:255'],
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
            // dd($b);
            // $data['banks'] = $response = Http::get("https://api.paystack.co/bank");
            // $all_banks = $response->json($key = null);
            
            $data['title'] = "User Dashboard - Settings";
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

    public function verifyBank(Request $request)
    {
        try {
            # code...
            $curl = curl_init();

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
                    User::where('id', Auth::user()->id)->update([
                        'bank_id' => $bank,
                        'acc_number' => $account_number,
                        'acc_name' => $response->data->account_name,
                        'acc_verified' => true
                    ]);
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
            if ($_POST) {
                $rules = array(
                    'title' => ['required', 'string', 'max:255'],
                    'name_of_author' => ['required', 'string', 'max:255'],
                    'version' => ['required', 'string', 'max:255'],
                    'price' => ['required', 'string', 'max:255'],
                    'amount' => ['required_if:price,==,Paid'],
                    'material_type_id' => ['required', 'max:255'],
                    'folder_id' => ['required_if:material_type,==,4'],
                    'year_of_publication' => ['required', 'string', 'max:255'],
                    'country_id' => ['required', 'string', 'max:255'],
                    'publisher' => ['required', 'string', 'max:255'],
                    'tags' => ['required', 'string', 'max:255'],
                    'subject_id' => ['required_if:material_type,==,4'],
                    'privacy_code' => ['required_if:material_type,==,4'],
                    'material_file_id' => ['required', 'max:50000'],
                    'material_cover_id' => ['required', 'max:5000'],
                    'material_desc' => ['required'],
                    'terms' => ['required', 'max:255']
                );

                $messages = [
                    'material_type_id.required' => __('The Material Type is required'),
                    'country_id.required' => __('Country of Publication is required'),
                    'subject_id.required' => __('The Subject name is required'),
                    'folder_id.required_if' => __('The Folder name is required'),
                    'material_file_id.required' => __('The Material File is required'),
                    'material_file_id.max' => __('The Material File size must not more than 50MB'),
                    'material_cover_id.required' => __('The Material Cover is required'),
                    'material_cover_id.max' => __('The Material Cover size must not more that 5MB')
                ];

                $validator = Validator::make($request->all(), $rules, $messages);

                if ($validator->fails()) {
                    Session::flash('warning', __('All fields are required'));
                    return back()->withErrors($validator)->withInput();
                }

                $tags = explode(",", $request->tags);

                if ($request->hasFile('material_file_id')) {
                    $material_file = $request->file('material_file_id');
                    $resize = Image::make($material_file)->fit(300);
                    $material_file_name = 'MaterialFile' . time() . '.' . $material_file->getClientOriginalExtension();
                    Storage::disk('material_file')->put($material_file_name, file_get_contents($material_file));
                    $save_file = File::create([
                        'name' => $material_file_name,
                        'url' => 'storage/materials/files/' . $material_file_name
                    ]);
                }

                if ($request->hasFile('material_cover_id')) {
                    $material_cover = $request->file('material_cover_id');
                    $material_cover_name = 'MaterialCover' . time() . '.' . $material_cover->getClientOriginalExtension();
                    Storage::disk('material_cover')->put($material_cover_name, file_get_contents($material_cover));
                    $save_cover = File::create([
                        'name' => $material_cover_name,
                        'url' => 'storage/materials/covers/' . $material_cover_name
                    ]);
                }

                Material::create([
                    'user_id' => Auth::user()->id,
                    'title' => $request->title ?? null,
                    'name_of_author' => $request->name_of_author ?? null,
                    'version' => $request->version ?? null,
                    'price' => $request->price ?? null,
                    'amount' => $request->amount ?? null,
                    'material_type_id' => $request->material_type_id ?? null,
                    'folder_id' => $request->folder_id ?? null,
                    'year_of_publication' => $request->year_of_publication ?? null,
                    'country_id' => $request->country_id ?? null,
                    'publisher' => $request->publisher ?? null,
                    'tags' => $tags,
                    'subject_id' => $request->subject_id ?? null,
                    'privacy_code' => $request->privacy_code ?? null,
                    'material_file_id' => $save_file->id,
                    'material_cover_id' => $save_cover->id,
                    'material_desc' => $request->material_desc ?? null
                ]);

                Session::flash('success', 'Material uploaded successfully');
                return redirect()->route('vendor.settings');
            }
            $data['title'] = "User Dashboard - Upload Material";
            $role = ['vendor'];
            $data['material_types'] = $m = MaterialType::where("status", "active")->whereJsonContains('role', $role)->get();
            $data['subjects'] = Subject::where("status", "active")->get();
            $data['countries'] = Country::all();
            $material_type_id = MaterialType::where(["status" => "active", "name" => "Case Law"])->whereJsonContains('role', $role)->get();
            $data['material_type_id'] = $mat_id = $material_type_id[0]['id'];
            $data['folders'] = $f = Folder::where(['user_id' => Auth::user()->id, 'material_type_id' => $mat_id])->get();
            return View('dashboard.vendor.upload', $data);
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
                );

                $messages = [];

                // dd($request->all());
                $validator = Validator::make($request->all(), $rules, $messages);

                if ($validator->fails()) {
                    Session::flash('warning', __('All fields are required'));
                    return back()->withErrors($validator)->withInput();
                }

                Folder::create([
                    "material_type_id" => $request->material_type_id,
                    "name" => $request->name,
                    "user_id" => Auth::user()->id
                ]);
                Session::flash('success', __('Folder added successfully'));
                return redirect()->back();
            }

            $data['title'] = "User Dashboard - Create New Folder";
            $role = ['vendor'];
            $data['material_types'] = $m = MaterialType::where("status", "active")->whereJsonContains('role', $role)->get();
            $material_type_id = MaterialType::where(["status" => "active", "name" => "Case Law"])->whereJsonContains('role', $role)->get();
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
}