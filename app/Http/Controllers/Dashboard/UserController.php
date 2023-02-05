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
use App\Models\User;
use Carbon\Carbon;
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

class UserController extends Controller
{
    public function __construct()
    {
        // dd(Auth::user());
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
            $mat_type = MaterialType::where('status', 'active')->get();
            $material_array = [];
            foreach ($mat_type as $key => $value) {
                # code...
                if (substr($value->mat_unique_id, 0, 3) == "CSL") {
                    # code...
                    $material = Material::where(['status' => 'active', 'material_type_id' => $value->id])->with(['type', 'folder'])->get();
                    $material_grp = $material->groupBy('folder_id');
                    $object = new \stdClass();
                    $object->type = $value;
                    $object->materials = $material_grp;
                    // Added property to the object
                    array_push($material_array, $object);
                } else {
                    # code...
                    $material = Material::where(['status' => 'active', 'material_type_id' => $value->id])->with(['type', 'folder'])->inRandomOrder()->limit(4)->get();
                    $object = new \stdClass();
                    $object->type = $value;
                    $object->materials = $material;
                    // Added property to the object
                    array_push($material_array, $object);
                }
            }

            $data['material_array'] = $material_array;

            // dd($material_array);
            return View('dashboard.user.bookstore', $data);
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
            $data['all_materials'] = Material::where(['folder_id' => $id])->with(['type', 'folder'])->get();
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
                $data['t_materials'] = $tm = Material::where(['material_type_id' => $mt->id])->with(['type', 'folder'])->get();
                $data['t_materials'] = $tm->groupBy('folder_id');
                $data['type'] = 'Folder';
            }
            $data['materials'] = $m = Material::where(['material_type_id' => $mt->id])->with(['type', 'folder'])->get();
            // dd($data);
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
            $data['my_materials'] = $my_materials = MaterialHistory::where(['user_id' => Auth::user()->id, 'is_rent_expired' => false])->get('material_id');
            foreach ($my_materials as $key => $value) {
                # code...
                array_push($my_materials_arr, $value->material_id);
            }
            $data['my_materials_arr'] = $my_materials_arr;
            $data['rent'] = 700;
            $data['title'] = "Vnedor Dashboard - Bookstore";
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

    public function library()
    {
        # code...
        try {
            //code...
            $my_materials_arr = [];
            $data['my_materials'] = $my_materials = MaterialHistory::where(['user_id' => Auth::user()->id, 'is_rent_expired' => false])->get('material_id');
            foreach ($my_materials as $key => $value) {
                # code...
                array_push($my_materials_arr, $value->material_id);
            }

            $data['notes'] = Note::where(['user_id' => Auth::user()->id])->inRandomOrder()->limit(4)->get();
            $data['title'] = "User Dashboard - My Library";
            $data['materials'] = $m = Material::where(['status' => 'active'])->whereIn('id', $my_materials_arr)->with(['type', 'folder'])->get();
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
            $data['title'] = "User Dashboard - Transactions";
            $data['transactions'] = Transaction::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();
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
                $team = Team::create([
                    'user_id' => Auth::user()->id,
                    'subscription_id' => $sub->id,
                    'teammates' => [Auth::user()->email],
                    'start_date' => $date,
                    'end_date' => $end_date,
                    'sub_status' => "active"
                ]);
                $team_id = $team->id;
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
            $date_rented_expired = null;
            if ($type == "rented") {
                # code...
                $date_rented_expired = Carbon::now()->addDays(2);
            }
            $data['invoice_id'] = $invoice_id = Str::upper("TRX" . $this->unique_code(12));
            $data['date'] = $date = Carbon::now();


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
                'date' => $date,
                'date_rented_expired' => $date_rented_expired,
                'type' => $type
            ]);

            return $data;
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

    public function access_material(Request $request, $id)
    {
        try {

            $data['note'] = $note = Note::where(['material_id' => $id, 'user_id' => Auth::user()->id])->first();
            // dd($note);

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
                    Note::create([
                        'user_id' => Auth::user()->id,
                        'material_id' => $id,
                        'title' => $request->title,
                        'content' => $request->content,
                    ]);
                }

                Note::where(['material_id' => $id, 'user_id' => Auth::user()->id])->update([
                    'title' => $request->title ?? $note->title,
                    'content' => $request->content ?? $note->content
                ]);

                Session::flash('success', "Note Saved successfully");
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
            $data['title'] = "User Dashboard - " . $material->title;
            return view('dashboard.user.view-material', $data)->header('Cache-Control', 'no-store, no-cache, must-revalidate, post-check=0, pre-check=0, max-age=0');;
        } catch (\Throwable $th) {
            dd($th->getMessage());
            //throw $th;
        }
    }

    public function send_note(Request $request, $id)
    {

        try {
            //code...

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

                $note = Note::where(['material_id' => $request->material_id, 'user_id' => Auth::user()->id])->first();

                if (!$note) {
                    Session::flash('error', "Note not found");
                    return redirect()->back();
                }

                $object = new \stdClass();
                $object->title = $note->title;
                $object->content = $note->content;
                $object->subject = $request->email_subject;

                Mail::to($request->email)->send(new SendNote($object));
                Session::flash('success', "Note sent");
                return redirect()->back();
            }
            $data['title'] = "User Dashboard - Send Note";
            $data['material'] = $material = Material::where('id', $id)->with(['type', 'folder', 'cover', 'file'])->first();
            // dd($material);
            return View('dashboard.user.send-note-modal', $data);
        } catch (\Throwable $th) {
            dd($th->getMessage());
            //throw $th;
        }
    }

    public function accept_invite($id)
    {
        # code...
        $decrypt = Crypt::decryptString($id);

        $team = Team::find($decrypt);
        $teammates = $team->teammates;
        array_push($teammates, Auth::user()->email);
        $team->teammates = $teammates;
        $team->save();
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
        Session::flash('success', 'Invite Accepted');
        return redirect()->route('user.index');
    }

    public function invite_teammate(Request $request)
    {

        try {
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
}