<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Mail\InviteTeamMember;
use App\Mail\SendNote;
use App\Models\Currency;
use App\Models\File;
use App\Models\Invite;
use App\Models\Material;
use App\Models\MaterialHistory;
use App\Models\MaterialType;
use App\Models\Messages;
use App\Models\Note;
use App\Models\SubHistory;
use App\Models\Subscription;
use App\Models\Team;
use App\Models\Transaction;
use App\Models\UnlockedTest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Smalot\PdfParser\Parser;
use stdClass;

class UserController extends Controller
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
            $data['limit_mat'] = [0, 1, 2, 3];
            $data['limit_folder'] = $limit_folder = [1, 2, 3, 4];
            $data['title'] = "User Dashboard - Bookstore";
            $mat_type = MaterialType::where('status', 'active')->orderBy('sort', 'ASC')->get();
            $material_array = [];


            $my_materials_arr = [];
            $all_my_materials_arr = [];
            if (Auth::user()->team_id) {
                # code...
                $team = Team::find(Auth::user()->team_id);
                foreach ($team->teammates as $key_2 => $value_2) {
                    # code...
                    $user = User::where('email', $value_2)->first();
                    $my_materials = MaterialHistory::where(['user_id' => $user->id, 'is_rent_expired' => false])->get();
                    foreach ($my_materials as $key => $value) {
                        # code...
                        array_push($my_materials_arr, $value->material_id);
                        array_push($all_my_materials_arr, $value);
                    }
                }
            } else {
                $data['my_materials'] = $my_materials = MaterialHistory::where(['user_id' => Auth::user()->id, 'is_rent_expired' => false])->get();
                foreach ($my_materials as $key => $value) {
                    # code...
                    array_push($my_materials_arr, $value->material_id);
                    array_push($all_my_materials_arr, $value);
                }
            }

            foreach ($mat_type as $key => $value) {
                # code...
                if (substr($value->mat_unique_id, 0, 3) == "CSL" || substr($value->mat_unique_id, 0, 3) == "LAW") {
                    # code...
                    $material = Material::where(['status' => 'active', 'material_type_id' => $value->id])->with(['type', 'folder', 'mat_his'])->get();
                    $material_grp = $material->groupBy('folder_id');
                    $object = new \stdClass();
                    $object->type = $value;
                    $object->materials = $material_grp;
                    array_push($material_array, $object);
                } else {
                    # code...
                    $material = Material::where(['status' => 'active', 'material_type_id' => $value->id])->with(['type', 'folder', 'mat_his'])->inRandomOrder()->limit(4)->get();
                    $object = new \stdClass();
                    $object->type = $value;
                    $object->materials = $material;
                    array_push($material_array, $object);
                }
            }

            $data['material_array'] = $material_array;
            $data['my_materials_arr'] = $my_materials_arr;
            $data['all_my_materials_arr'] = $all_my_materials_arr;

            if ($_GET) {
                if (isset($_GET['search'])) {
                    $search = $_GET['search'];
                    $data['material_array'] = Material::where('tags', 'LIKE', '%' . $search . '%')->orWhere('title', 'LIKE', '%' . $search . '%')->with('mat_his')->get()
                    ->map(function ($row) use ($search) {
                        $row->title = preg_replace('/(' . $search . ')/i', "<b class='search-text'>$1</b>", [$row->title]);
                        $row->tags = preg_replace('/(' . $search . ')/i', "<b class='search-text'>$1</b>", $row->tags);
                        return $row;
                    });

                    // $data['material_array'] = DB::table('material_histories')
                    // ->join('materials', 'material_histories.material_id', '=', 'materials.id')
                    // ->join('material_types', 'materials.material_type_id', '=', 'material_types.id')
                    // ->join('files', 'materials.material_cover_id', '=', 'files.id')
                    // ->where('materials.tags', 'LIKE', '%' . $search . '%')
                    // ->orWhere('materials.title', 'LIKE', '%' . $search . '%')
                    // ->select('material_histories.id as mat_his_id', 'materials.*', 'files.url as cover', 'material_types.name as type_name', 'material_types.id as type_id')
                    // ->whereIn('material_histories.unique_id', $my_materials_arr)
                    // ->get();

                    // $bank_name = $row['bank_name'];
                    // $account_name = $row['account_name'];
                    // $account_number = $row['account_number'];
                    // $bank_IFSC_code = $row['bank_IFSC_code'];
                    // $country = $row['country'];
                    return View('dashboard.user.search', $data);
                }
            }

            return View('dashboard.user.bookstore', $data);
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
            $my_materials_arr = [];
            $my_materials_array = [];
            if (Auth::user()->team_id) {
                # code...
                $team = Team::find(Auth::user()->team_id);
                foreach ($team->teammates as $key_2 => $value_2) {
                    # code...
                    $user = User::where('email', $value_2)->first();
                    $my_materials = MaterialHistory::where(['user_id' => $user->id, 'is_rent_expired' => false])->get(['material_id', 'unique_id']);
                    foreach ($my_materials as $key => $value) {
                        # code...
                        array_push($my_materials_arr, $value->unique_id);
                    }
                }
            } else {
                $data['my_materials'] = $my_materials = MaterialHistory::where(['user_id' => Auth::user()->id, 'is_rent_expired' => false])->get(['material_id', 'unique_id']);
                foreach ($my_materials as $key => $value) {
                    # code...
                    array_push($my_materials_arr, $value->unique_id);
                }
            }

            if ($_GET) {
                if (isset($_GET['search']) && !empty($_GET['search'])) {
                    $search = $_GET['search'];
                    // $data['material_array'] = Material::where('tags', 'LIKE', '%' . $search . '%')->orWhere('title', 'LIKE', '%' . $search . '%')->whereIn('unique_id', $my_materials_arr)->with('mat_his')->get()
                    // ->map(function ($row) use ($search) {
                    //     $row->title = preg_replace('/(' . $search . ')/i', "<b class='search-text'>$1</b>", [$row->title]);
                    //     $row->tags = preg_replace('/(' . $search . ')/i', "<b class='search-text'>$1</b>", $row->tags);
                    //     return $row;
                    // });

                    $data['material_array'] = DB::table('material_histories')
                    ->join('materials', 'material_histories.material_id', '=', 'materials.id')
                    ->join('material_types', 'materials.material_type_id', '=', 'material_types.id')
                    ->join('files', 'materials.material_cover_id', '=', 'files.id')
                    ->where('materials.tags', 'LIKE', '%' . $search . '%')
                        ->orWhere('materials.title', 'LIKE', '%' . $search . '%')
                        ->select('material_histories.id as mat_his_id', 'material_histories.is_rent_expired as is_rent_expired', 'material_histories.type as mat_his_type', 'materials.*', 'files.url as mat_cover', 'material_types.name as type_name', 'material_types.id as type_id')
                        ->whereIn('material_histories.unique_id', $my_materials_arr)
                        ->get()
                        ->map(function ($row) use ($search) {
                            $row->title = preg_replace('/(' . $search . ')/i', "<b class='search-text'>$1</b>", [$row->title]);
                            $row->tags = preg_replace('/(' . $search . ')/i', "<b class='search-text'>$1</b>", $row->tags);
                            return $row;
                        });

                    return View('dashboard.user.search', $data);
                }
            }


            $data['notes'] = Note::where(['user_id' => Auth::user()->id])->latest()->limit(5)->get();
            $data['title'] = "User Dashboard - My Library";
            // $data['materials'] = $m = Material::where(['status' => 'active'])->whereIn('id', $my_materials_arr)->with(['type', 'folder'])->get();
            $data['materials'] = $mm = DB::table('material_histories')
            ->join('materials', 'material_histories.material_id', '=', 'materials.id')
            ->join('material_types', 'materials.material_type_id', '=', 'material_types.id')
            // ->join('folders', 'materials.folder_id', '=', 'folders.id')
            ->join('files', 'materials.material_cover_id', '=', 'files.id')
            ->select('material_histories.id as mat_his_id', 'material_histories.is_rent_expired as is_rent_expired', 'material_histories.type as mat_his_type', 'material_histories.unique_id as mat_his_unique_id', 'materials.*', 'files.url as mat_cover', 'material_types.name as type_name', 'material_types.id as type_id')
            ->whereIn('material_histories.unique_id', $my_materials_arr)
                ->where(['materials.status' => 'active'])
                ->get();
            // dd($mm);
            return View('dashboard.user.library', $data);
        } catch (\Throwable $th) {
            //throw $th;
            dd($th->getMessage());
        }
    }

    public function view_folder($id)
    {
        # code...
        try {
            //code...
            $my_materials_arr = [];
            $all_my_materials_arr = [];
            if (Auth::user()->team_id) {
                # code...
                $team = Team::find(Auth::user()->team_id);
                foreach ($team->teammates as $key_2 => $value_2) {
                    # code...
                    $user = User::where('email', $value_2)->first();
                    $my_materials = MaterialHistory::where(['user_id' => $user->id, 'is_rent_expired' => false])->get();
                    foreach ($my_materials as $key => $value) {
                        # code...
                        array_push($my_materials_arr, $value->material_id);
                        array_push($all_my_materials_arr, $value);
                    }
                }
            } else {
                $data['my_materials'] = $my_materials = MaterialHistory::where(['user_id' => Auth::user()->id, 'is_rent_expired' => false])->get();
                foreach ($my_materials as $key => $value) {
                    # code...
                    array_push($my_materials_arr, $value->material_id);
                    array_push($all_my_materials_arr, $value);
                }
            }

            $data['my_materials_arr'] = $my_materials_arr;
            $data['all_my_materials_arr'] = $all_my_materials_arr;
            $data['all_materials'] = Material::where(['folder_id' => $id])->with(['type', 'folder', 'mat_his'])->get();
            return View('dashboard.user.view-folder', $data);
        } catch (\Throwable $th) {
            //throw $th;
            dd($th->getMessage());
        }
    }

    public function view_material_type($id)
    {
        # code...
        try {
            //code...
            $data['limit_folder'] = [1, 2, 3, 4];
            $data['type'] = 'Material';
            $data['material_type'] = $mt = MaterialType::where(['id' => $id])->first();
            if (!$mt) {
                # code...
                Session::flash('warning', "No record found");
                return back();
            }
            if (substr($mt->mat_unique_id, 0, 3) == "CSL") {
                $data['t_materials'] = $tm = Material::where(['material_type_id' => $mt->id])->with(['type', 'folder', 'mat_his'])->get();
                $data['t_materials'] = $tm->groupBy('folder_id');
                $data['type'] = 'Folder';
            }

            $my_materials_arr = [];
            $all_my_materials_arr = [];
            if (Auth::user()->team_id) {
                # code...
                $team = Team::find(Auth::user()->team_id);
                foreach ($team->teammates as $key_2 => $value_2) {
                    # code...
                    $user = User::where('email', $value_2)->first();
                    $my_materials = MaterialHistory::where(['user_id' => $user->id, 'is_rent_expired' => false])->get();
                    foreach ($my_materials as $key => $value) {
                        # code...
                        array_push($my_materials_arr, $value->material_id);
                        array_push($all_my_materials_arr, $value);
                    }
                }
            } else {
                $data['my_materials'] = $my_materials = MaterialHistory::where(['user_id' => Auth::user()->id, 'is_rent_expired' => false])->get();
                foreach ($my_materials as $key => $value) {
                    # code...
                    array_push($my_materials_arr, $value->material_id);
                    array_push($all_my_materials_arr, $value);
                }
            }

            $data['my_materials_arr'] = $my_materials_arr;
            $data['all_my_materials_arr'] = $all_my_materials_arr;

            $data['materials'] = $m = Material::where(['material_type_id' => $mt->id])->with(['type', 'folder', 'mat_his'])->get();


            if (substr($mt->mat_unique_id, 0, 3) == "TAA") {
                $data['materials'] = $m = Material::where(['material_type_id' => $mt->id, 'university_id' => Auth::user()->university_id])->with(['type', 'folder', 'mat_his'])->get();
            }

            $data['title'] = $mt->name;
            return View('dashboard.user.view-all-material-type', $data);
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
            $my_materials_arr = [];
            if (Auth::user()->team_id) {
                # code...
                $team = Team::find(Auth::user()->team_id);
                foreach ($team->teammates as $key_2 => $value_2) {
                    # code...
                    $user = User::where('email', $value_2)->first();
                    $my_materials = MaterialHistory::where(['user_id' => $user->id, 'is_rent_expired' => false])->get('material_id');
                    foreach ($my_materials as $key => $value) {
                        # code...
                        array_push($my_materials_arr, $value->material_id);
                    }
                }
            } else {
                $data['my_materials'] = $my_materials = MaterialHistory::where(['user_id' => Auth::user()->id, 'is_rent_expired' => false])->get('material_id');
                foreach ($my_materials as $key => $value) {
                    # code...
                    array_push($my_materials_arr, $value->material_id);
                }
            }


            $data['my_materials_arr'] = $my_materials_arr;
            $data['title'] = "User Dashboard - Bookstore";
            $data['material'] = $m = Material::where(['id' => $id])->with(['type', 'cover', 'country', 'folder', 'subject', 'test_country', 'university'])->first();
            if (!$m) {
                # code...
                Session::flash('warning', "No material found");
                return back();
            }
            $data['typeName'] = '';
            $data['rentedMatCount'] = $rentedMatCount = MaterialHistory::where(['user_id' => Auth::user()->id, 'is_rent_expired' => false, 'type' => 'rented'])->get()->count();
            // dd($rentedMatCount);
            $data['pageCount'] = countPages(public_path($m->file->url));
            return View('dashboard.user.view', $data);
        } catch (\Throwable $th) {
            dd($th->getMessage());
            //throw $th;
        }
    }

    public function transactions()
    {
        # code...
        try {
            //code...
            $data['title'] = "User Dashboard - Transactions";
            $data['sn'] = 1;
            $data['transactions'] = Transaction::where('user_id', Auth::user()->id)->orderBy('created_at', 'DESC')->get();
            return View('dashboard.user.transactions', $data);
        } catch (\Throwable $th) {
            //throw $th;
            dd($th->getMessage());
        }
    }

    public function summary_material($id)
    {
        # code...
        try {
            //code...
            $data['title'] = "User Dashboard - My Library";
            return View('dashboard.user.material-summary', $data);
        } catch (\Throwable $th) {
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

    public function subscriptions()
    {
        # code...
        try {
            //code...
            $data['title'] = "Subsciptions";
            $data['subs'] = Subscription::all();
            $data['user_sub'] = $user_sub = SubHistory::find(Auth::user()->sub->id);
            // dd($user_sub->sub);
            $trans = Transaction::where(['user_id' => Auth::user()->id, 'type' => 'subscription'])->latest()->first();
            $data['sub_name'] = $user_sub->sub->id ?? null;
            $data['sub_amount'] = $trans->amount ?? null;
            $data['sub_id'] = $user_sub->sub ?? null;
            // dd($trans->amount);
            return View('dashboard.user.subscriptions', $data);
        } catch (\Throwable $th) {
            dD($th->getMessage());
            //throw $th;
        }
    }

    public function sub_text($id)
    {
        # code...
        try {
            //code...
            $data['title'] = "Subscribe";
            $material = Material::find($id);
            if ($material->price == "Paid") {
                $data['type'] = "buy";
            } else {
                $data['type'] = "access";
            }
            return View('dashboard.user.sub_text', $data);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function help(Request $request)
    {
        # code...
        try {
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
                    'isMedia' => $isMedia,
                ];

                return $data;
            }
            //code...
            $data['title'] = "User Dashboard - Help";
            $data['messages'] = Messages::where('user_id', Auth::user()->id)->with(['file', 'user', 'admin'])->orderBy('created_at', 'ASC')->get();
            $data['email'] = "virtuallawlibrary@gmail.com";
            return View('dashboard.user.help', $data);
        } catch (\Throwable $th) {
            return $th->getMessage();
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
                return redirect()->route('user.settings');
            }

            $data['sub'] = SubHistory::where('id', Auth::user()->sub_id)->with('sub')->first();
            $data['title'] = "User Dashboard - Settings";
            $data['team'] = $team = Team::find(Auth::user()->team_id);
            $data['invite'] = $invite = Invite::where(['email' => Auth::user()->email, 'team_id' => Auth::user()->team_id, 'status' => 'accept'])->first();
            $data['sn'] = 1;
            // dd($team);
            return View('dashboard.user.settings', $data);
        } catch (\Throwable $th) {
            //throw $th;
            dd($th->getMessage());
        }
    }

    public function buy_rent_material(Request $request)
    {
        # code...
        try {
            //code...
            $data['status'] = true;
            $data['mat_id'] = $mat_id = $request->mat_id;
            $data['reference'] = $reference =  $request->reference;
            $data['status'] = $status = $request->status;
            $data['trxref'] = $trxref = $request->trxref;
            $data['amount'] = $amount = $request->amount;
            $data['type'] = $type = $request->type;
            $rent_count = 0;
            $rent_unique_id = 0;
            if ($type == "rented") {
                # code...
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
            $data['invoice_id'] = $invoice_id = Str::upper("TRX" . $this->unique_code(12));
            $data['date'] = $date = Carbon::now();



            $my_materials_arr = [];
            $my_materials = MaterialHistory::where(['user_id' => Auth::user()->id, 'is_rent_expired' => false])->get('material_id');
            foreach ($my_materials as $key => $value) {
                # code...
                array_push($my_materials_arr, $value->material_id);
            }

            $trans = Transaction::create([
                'user_id' => Auth::user()->id,
                'invoice_id' => $invoice_id,
                'date' => $date,
                'amount' => $amount,
                'status' => $status,
                'reference' => $reference,
                'trxref' => $trxref,
                'type' =>  $type
            ]);

            MaterialHistory::create([
                'user_id' => Auth::user()->id,
                'material_id' => $mat_id,
                'transaction_id' => $trans->id,
                'invoice_id' => $invoice_id,
                'unique_id' => Str::upper("MATHIS" . $this->unique_code(12)),
                'rent_count' => $rent_count,
                'rent_unique_id' => $rent_unique_id,
                'date_rented_expired' => $date_rented_expired ?? null,
                'type' => $type
            ]);

            return $data;
        } catch (\Throwable $th) {
            return $th->getMessage();
            // dd($th->getMessage());
            //throw $th;
        }
    }

    public function second_rent($id)
    {
        # code...
        try {
            //code...
            $rent_pending = MaterialHistory::where(['user_id' => Auth::user()->id, 'type' => 'rented', 'is_rent_expired' => false])->where('rent_count', '<', 2)->with('trans')->latest()->first();

            MaterialHistory::where(['user_id' => Auth::user()->id, 'type' => 'rented', 'is_rent_expired' => false, 'id' => $rent_pending->id, 'rent_unique_id' => $rent_pending->rent_unique_id])->update(['rent_count' => 2]);
            MaterialHistory::create([
                'user_id' => Auth::user()->id,
                'material_id' => $id,
                'transaction_id' => $rent_pending->trans->id,
                'invoice_id' => $rent_pending->invoice_id,
                'unique_id' => Str::upper("MATHIS" . $this->unique_code(12)),
                'rent_count' => 2,
                'rent_unique_id' => $rent_pending->rent_unique_id,
                'date_rented_expired' => $rent_pending->date_rented_expired,
                'type' => 'rented'
            ]);

            Session::flash('success', 'Material added to my library successfully');
            return redirect()->route('user.library');
        } catch (\Throwable $th) {
            dd($th->getMessage());
            //throw $th;
        }
    }

    public function add_to_library($id)
    {
        # code...
        try {
            //code...

            MaterialHistory::create([
                'user_id' => Auth::user()->id,
                'material_id' => $id,
                'unique_id' => Str::upper("MATHIS" . $this->unique_code(12)),
                'transaction_id' => null,
                'date' =>  Carbon::now(),
                'type' => 'free'
            ]);

            Session::flash('success', 'Material added to my library successfully');
            return redirect()->route('user.library');
        } catch (\Throwable $th) {
            dd($th->getMessage());
            //throw $th;
        }
    }

    public function set_current_note(Request $request)
    {
        # code...
        if ($_POST) {
            $note_id = $request->note_id;
            $type = $request->type;
            if ($type == "new") {
                Session::forget('current_note');
            } elseif ($type == "view") {
                Session::put('current_note', $note_id);
            }
            $object = new \stdClass();
            $object->new_note = Session::get('new_note');
            $object->current_note = $current_note = Session::get('current_note');
            $object->note = Note::where(['id' => $current_note, 'user_id' => Auth::user()->id])->first();;
            return $object;
        }
        return redirect()->back();
    }

    public function access_material(Request $request, $id)
    {
        try {
            $current_note = Session::get('current_note');
            $note = null;

            if ($current_note) {
                $note = Note::where(['id' => $current_note, 'user_id' => Auth::user()->id])->first();
            } else {
                $note = Note::where(['material_id' => $id, 'user_id' => Auth::user()->id])->first();
            }

            if (isset($note)) {
                Session::put('current_note', $note->id);
            }
            $data['note'] = $note;
            $data['current_note'] = $current_note;
            $data['notes'] = Note::where(['user_id' => Auth::user()->id])->get();

            if ($_POST) {
                # code...
                $rules = array(
                    'title' => ['required', 'string', 'max:255'],
                );

                $validator = Validator::make($request->all(), $rules);

                if ($validator->fails()) {
                    Session::flash('warning', __('Note title is required'));
                    return back()->withErrors($validator)->withInput();
                }

                if (!$note) {
                    $save_note = Note::create([
                        'user_id' => Auth::user()->id,
                        'material_id' => $id,
                        'title' => $request->title,
                        'content' => $request->content,
                    ]);

                    Session::put('current_note', $save_note->id);
                    return true;
                }

                Note::where(['material_id' => $id, 'user_id' => Auth::user()->id, 'id' => $note->id])->update([
                    'title' => $request->title ?? $note->title,
                    'content' => $request->content ?? $note->content
                ]);

                Session::flash('success', "Note Saved successfully");
                Session::forget('current_note');
                return true;
                return redirect()->back();
            }

            //code...
            $data['material'] = $material = Material::where('id', $id)->with(['type', 'folder', 'cover', 'file'])->first();
            if (!$material) {
                Session::flash('error', 'This material has been removed');
                return redirect()->route('user.index');
            }
            $mat_his = MaterialHistory::where(['material_id' => $material->id, 'user_id' => Auth::user()->id, 'is_rent_expired' => false])->get();
            if (!$mat_his) {
                Session::flash('error', 'Can not access this material');
                return redirect()->route('user.index');
            }

            $unlocked_tests_arr = [];
            $unlocked_tests = UnlockedTest::where('user_id', Auth::user()->id)->get();
            foreach ($unlocked_tests as $value) {
                array_push($unlocked_tests_arr, $value->material_id);
            }
            $data['unlocked_tests'] = $unlocked_tests_arr;
            $data['title'] = "User Dashboard - " . $material->title;
            return view('dashboard.user.view-material', $data);
        } catch (\Throwable $th) {
            dd($th->getMessage());
            //throw $th;
        }
    }

    public function send_note(Request $request, $id)
    {

        try {
            //code...
            $current_note = Session::get('current_note');
            $data['title'] = "User Dashboard - Send Note";
            $data['note'] = $note = Note::where(['user_id' => Auth::user()->id, 'id' => $current_note])->first();

            if (!$note) {
                Session::flash('warning', 'No note found');
                return redirect()->back();
            }

            if ($_POST) {
                $rules = array(
                    'email' => ['required', 'max:255'],
                    'email_subject' => ['required', 'max:255'],
                );

                $validator = Validator::make($request->all(), $rules);

                if ($validator->fails()) {
                    Session::flash('warning', __('All fields are required'));
                    return back()->withErrors($validator)->withInput();
                }

                $object = new \stdClass();
                $object->title = $note->title;
                $object->content = $note->content;
                $object->subject = $request->email_subject;

                Mail::to($request->email)->send(new SendNote($object));
                Session::flash('success', "Note sent");
                Session::forget('current_note');
                return redirect()->back();
            }
            return View('dashboard.user.send-note-modal', $data);
        } catch (\Throwable $th) {
            dd($th->getMessage());
            //throw $th;
        }
    }

    public function remove_teammate($team_id, $email)
    {
        # code...
        $team = Team::find($team_id);
        $teammates = $team->teammates;
        if (in_array($email, $teammates)) {
            foreach ($teammates as $key => $value) {
                # code...
                if ($email == $value) {
                    unset($teammates[$key]);
                }
            }
            $team->teammates = $teammates;
            $team->save();
        }
        User::where('email', $email)->update(['team_id' => null]);
        $invite = Invite::where(['email' => $email, 'team_id' => $team->id])->where('status', 'accept')->orWhere('status', null)->first();
        $invite->status = 'removed';
        $invite->save();
        Session::flash('success', 'Team Member removed');
        return redirect()->route('user.settings');
    }

    public function accept_invite($id)
    {
        # code...
        $decrypt = Crypt::decryptString($id);

        $team = Team::find($decrypt);
        $teammates = $team->teammates;
        if (!in_array(Auth::user()->email, $teammates)) {
            array_push($teammates, Auth::user()->email);
            $team->teammates = $teammates;
            $team->save();
        }
        User::where('email', Auth::user()->email)->update(['team_id' => $team->id]);
        $invite = Invite::where(['email' => Auth::user()->email, 'team_id' => $team->id])->where('status', 'decline')->orWhere('status', null)->first();
        $invite->status = 'accept';
        $invite->date_accepted = Carbon::now();
        $invite->save();
        Session::flash('success', 'Invite Accepted');
        return redirect()->route('user.index');
    }

    public function decline_invite($id)
    {
        # code...
        // $decrypt = Crypt::decryptString($id);
        // $team = Team::find($decrypt);
        // $teammates = $team->teammates;
        // array_push($teammates, Auth::user()->email);
        // $team->teammates = $teammates;
        // $team->save();
        Session::flash('success', 'Invite Declined');
        return redirect()->route('home');
    }

    public function invite_teammate(Request $request)
    {

        try {
            $sub_his = SubHistory::where('id', Auth::user()->sub_id)->with('sub')->first();
            //code...
            if ($_POST) {
                $rules = array(
                    'email' => ['required', 'max:255'],
                );

                $validator = Validator::make($request->all(), $rules);

                if ($validator->fails()) {
                    Session::flash('warning', __('All fields are required'));
                    return back()->withErrors($validator)->withInput();
                }

                $team = Team::find(Auth::user()->team_id);

                if (count($team->teammates) > $sub_his->sub->max_teammate) {
                    Session::flash('error', "Maximum number of team member reached");
                    return redirect()->route('user.settings');
                }
                
                $encrypt = Crypt::encryptString($team->id);
                Invite::create([
                    'email' => $request->email,
                    'team_id' => $team->id
                ]);

                Mail::to($request->email)->send(new InviteTeamMember($encrypt));
                Session::flash('success', "Invite Sent");
                return redirect()->route('user.settings');
            }
            $data['title'] = "User Dashboard - Invite Teammate";
            // $data['material'] = $material = Material::where('id', $id)->with(['type', 'folder', 'cover', 'file'])->first();
            // dd($material);
            return View('dashboard.user.add-teammate', $data);
        } catch (\Throwable $th) {
            dd($th->getMessage());
            //throw $th;
        }
    }

    public function notes()
    {
        try {
            //code... 
            $data['title'] = "My Notes";
            $data['notes'] = Note::where(['user_id' => Auth::user()->id])->get();
            return View('dashboard.user.notes', $data);
        } catch (\Throwable $th) {
            dd($th->getMessage());
            //throw $th;
        }
    }

    public function note(Request $request, $id)
    {
        try {
            //code... 
            $data['note'] = $note = Note::where(['user_id' => Auth::user()->id, 'id' => $id])->first();

            if (!$note) {
                Session::flash('warning', 'No note found');
                return redirect()->back();
            }

            $data['title'] = $note->title;

            if ($_POST) {
                # code...
                $rules = array(
                    'title' => ['required', 'string', 'max:255'],
                );

                $validator = Validator::make($request->all(), $rules);

                if ($validator->fails()) {
                    Session::flash('warning', __('Note title is required'));
                    return back()->withErrors($validator)->withInput();
                }

                Note::where(['user_id' => Auth::user()->id, 'id' => $note->id])->update([
                    'title' => $request->title ?? $note->title,
                    'content' => $request->content ?? $note->content
                ]);

                Session::flash('success', "Note Saved successfully");
                Session::forget('current_note');
                return true;
            }
            return View('dashboard.user.note-view', $data);
        } catch (\Throwable $th) {
            dd($th->getMessage());
            //throw $th;
        }
    }

    public function unlock_test(Request $request)
    {
        try {
            //code... 
            $material = Material::find($request->material_id);
            $object = new \stdClass();

            if (!$material) {
                Session::flash('warning', 'No material found');
                $object->status = false;
                return $object;
            }

            $object->material_id = $material->id;
            $code = $request->code;

            if ($code == $material->privacy_code) {
                # code...
                UnlockedTest::create([
                    'material_id' => $request->material_id,
                    'user_id' => Auth::user()->id,
                ]);
                $object->status = true;
                return $object;
            } else {
                $object->status = false;
                return $object;
            }
        } catch (\Throwable $th) {
            return false;
            dd($th->getMessage());
            //throw $th;
        }
    }
}