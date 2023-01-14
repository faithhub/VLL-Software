<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\File;
use App\Models\Material;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function __construct()
    {
        // dd(Auth::user());

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
            $data['title'] = "User Dashboard - Bookstore";
            $data['materials'] = $this->materials;
            $data['videos'] = $this->videos;
            $data['all_materials3'] = $m = Material::with('type')->get();
            $data['all_materials3'] = $m->groupBy('material_type_id');
            // foreach ($grp as $key => $value) {
            //     # code...
            //     // dd($value[0]->type->name);
            //     foreach ($value as $key => $value) {
            //         # code...
            //         dd($key, $value);
            //     }
            // }
            // dd($m);
            return View('dashboard.user.bookstore', $data);
        } catch (\Throwable $th) {
            //throw $th;
            dd($th->getMessage());
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
            $data['material'] = $m = Material::where(['id' => $id])->with(['type', 'cover', 'country', 'folder', 'subject'])->first();
            if (!$m) {
                # code...
                Session::flash('warning', "No material found");
                return back();
            }
            $data['typeName'] = '';
            $data['totalRented'] = 0;
            $data['totalBought'] = 0;
            $data['pageCount'] = countPages(public_path($m->file->url));
            return View('dashboard.user.view', $data);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function library()
    {
        # code...
        try {
            //code...
            $data['title'] = "User Dashboard - My Library";
            $data['materials'] = $this->materials;
            return View('dashboard.user.library', $data);
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
            $data['title'] = "User Dashboard - My Library";
            $data['transactions'] = $this->materials;
            return View('dashboard.user.transactions', $data);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function summary_material($id)
    {
        # code...
        try {
            //code...
            $data['title'] = "User Dashboard - My Library";
            $data['transactions'] = $this->materials;
            return View('dashboard.user.material-summary', $data);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function subscriptions()
    {
        # code...
        try {
            //code...
            $data['title'] = "Subsciptions";
            $data['subs'] = Subscription::all();
            return View('dashboard.user.subscriptions', $data);
        } catch (\Throwable $th) {
            dD($th->getMessage());
            //throw $th;
        }
    }

    public function help()
    {
        # code...
        try {
            //code...
            $data['title'] = "User Dashboard - Help";
            $data['email'] = "virtuallawlibrary@gmail.com";
            return View('dashboard.user.help', $data);
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
                return redirect()->route('user.settings');
            }


            $data['title'] = "User Dashboard - Settings";
            return View('dashboard.user.settings', $data);
        } catch (\Throwable $th) {
            //throw $th;
            dd($th->getMessage());
        }
    }
}