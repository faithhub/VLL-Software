<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Mail\InviteTeamMember;
use App\Mail\SendNote;
use App\Models\Currency;
use App\Models\File;
use App\Models\Folder;
use App\Models\Meeting;
use App\Models\Invite;
use App\Models\Material;
use App\Models\MaterialHistory;
use App\Models\MaterialType;
use App\Models\Messages;
use App\Models\MasterClass;
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
use Illuminate\Support\Facades\Hash;
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
            $data['limit_folder'] = $limit_folder = [0, 1, 2, 3];
            $data['title'] = "User Dashboard - Bookstore";
            $mat_type = MaterialType::where('status', 'active')->orderBy('sort', 'ASC')->get();
            $material_array = [];
            $bought_folders = [];
            $free_folders = [];
            $bought_and_free_folders = [];

            $my_materials_arr = [];
            $my_classes_arr = [];
            $all_classes_arr = [];
            $all_my_materials_arr = [];
            if (Auth::user()->team_id) {
                # code...
                $team = Team::find(Auth::user()->team_id);
                foreach ($team->teammates as $key_2 => $value_2) {
                    # code...
                    $user = User::where('email', $value_2)->first();
                    $all_classes = MaterialHistory::where(['user_id' => $user->id])->whereNotNull('class_id')->get();
                    foreach ($all_classes as $key3 => $value3) {
                        # code...
                        array_push($my_classes_arr, $value3->class_id);
                        array_push($all_classes_arr, $value3);
                    }
                    $my_materials = MaterialHistory::where(['user_id' => $user->id, 'is_rent_expired' => false])->get();
                    $all_folders = MaterialHistory::where(['user_id' => $user->id, "mat_type" => "folder", 'isFolderExpired' => false])->get();
                    foreach ($all_folders as $key2 => $value2) {
                        # code...
                        array_push($bought_and_free_folders, $value2->folder_id);
                        if ($value2->type == "bought") {
                            array_push($bought_folders, $value2->folder_id);
                        }
                        if ($value2->type == "free") {
                            array_push($free_folders, $value2->folder_id);
                        }
                    }

                    foreach ($my_materials as $key => $value) {
                        # code...
                        array_push($my_materials_arr, $value->material_id);
                        array_push($all_my_materials_arr, $value);
                    }
                }
            } else {
                $all_classes = MaterialHistory::where(['user_id' => Auth::user()->id])->whereNotNull('class_id')->get();
                foreach ($all_classes as $key3 => $value3) {
                    # code...
                    array_push($my_classes_arr, $value3->class_id);
                    array_push($all_classes_arr, $value3);
                }
                $data['my_materials'] = $my_materials = MaterialHistory::where(['user_id' => Auth::user()->id, 'is_rent_expired' => false])->get();
                $all_folders = MaterialHistory::where(['user_id' => Auth::user()->id, "mat_type" => "folder", 'isFolderExpired' => false])->get();
                foreach ($all_folders as $key2 => $value2) {
                    # code...
                    array_push($bought_and_free_folders, $value2->folder_id);
                    if ($value2->type == "bought") {
                        array_push($bought_folders, $value2->folder_id);
                    }
                    if ($value2->type == "free") {
                        array_push($free_folders, $value2->folder_id);
                    }
                }

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
                    $material_grp = $material->groupBy('folder_id')->values();
                    $object = new \stdClass();
                    $object->type = $value;
                    $object->materials = $material_grp;
                    array_push($material_array, $object);
                } elseif (substr($value->mat_unique_id, 0, 3) == "MCL") {
                    $data['classes'] = $classes = MasterClass::with(['cover', 'class_his'])->inRandomOrder()->limit(4)->get();
                    $object = new \stdClass();
                    $object->type = $value;
                    $object->materials = $classes;
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


            $data['bought_folders'] = $bought_folders;
            $data['free_folders'] = $free_folders;
            $data['my_classes_arr'] = $my_classes_arr;
            $data['all_classes_arr'] = $all_classes_arr;
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
            Session::flash('warning', $th->getMessage());
            return back() ?? redirect()->route('user');
        }
    }

    public function library()
    {
        # code...
        try {
            //code...
            $my_materials_arr = [];
            $my_materials_array = [];
            $bought_folders = [];
            $free_folders = [];
            $bought_and_free_folders = [];

            $all_classes_arr = [];
            $my_classes_arr = [];

            if (Auth::user()->team_id) {
                # code...
                $team = Team::find(Auth::user()->team_id);
                foreach ($team->teammates as $key_2 => $value_2) {
                    # code...
                    $user = User::where('email', $value_2)->first();
                    $all_classes = MaterialHistory::where(['user_id' => $user->id])->whereNotNull('class_id')->get();
                    foreach ($all_classes as $key3 => $value3) {
                        # code...
                        array_push($my_classes_arr, $value3->class_id);
                        array_push($all_classes_arr, $value3);
                    }


                    $my_materials = MaterialHistory::where(['user_id' => $user->id, 'is_rent_expired' => false])->get();
                    $all_folders = MaterialHistory::where(['user_id' => $user->id, "mat_type" => "folder", 'isFolderExpired' => false])->get();
                    foreach ($all_folders as $key2 => $value2) {
                        # code...
                        array_push($bought_and_free_folders, $value2->folder_id);
                        if ($value2->type == "bought") {
                            array_push($bought_folders, $value2->folder_id);
                        }
                        if ($value2->type == "free") {
                            array_push($free_folders, $value2->folder_id);
                        }
                    }
                    foreach ($my_materials as $key => $value) {
                        # code...
                        array_push($my_materials_arr, $value->unique_id);
                    }
                }
            } else {
                $all_classes = MaterialHistory::where(['user_id' => Auth::user()->id])->whereNotNull('class_id')->get();
                foreach ($all_classes as $key3 => $value3) {
                    # code...
                    array_push($my_classes_arr, $value3->class_id);
                    array_push($all_classes_arr, $value3);
                }


                $data['my_materials'] = $my_materials = MaterialHistory::where(['user_id' => Auth::user()->id, 'is_rent_expired' => false])->get();
                $all_folders = MaterialHistory::where(['user_id' => Auth::user()->id, "mat_type" => "folder", 'isFolderExpired' => false])->get();
                foreach ($all_folders as $key2 => $value2) {
                    # code...
                    array_push($bought_and_free_folders, $value2->folder_id);
                    if ($value2->type == "bought") {
                        array_push($bought_folders, $value2->folder_id);
                    }
                    if ($value2->type == "free") {
                        array_push($free_folders, $value2->folder_id);
                    }
                }

                foreach ($my_materials as $key => $value) {
                    # code...
                    // dd($value);
                    array_push($my_materials_arr, $value->unique_id);
                }
            }
            // dd($free_folders, $bought_folders);

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
                        ->select('material_histories.id as mat_his_id', 'material_histories.is_rent_expired as is_rent_expired', 'material_histories.type as mat_his_type', 'materials.*', 'files.url as mat_cover', 'material_histories.unique_id as mat_his_unique_id', 'material_types.mat_unique_id as mat_unique_id', 'material_types.name as type_name', 'material_types.id as type_id')
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

            $data['all_classes_arr'] = $all_classes_arr;
            $data['my_classes_arr'] = $my_classes_arr;
            
            $data['notes'] = Note::where(['user_id' => Auth::user()->id])->latest()->limit(5)->get();
            $data['title'] = "User Dashboard - My Library";
            $data['bought_folders'] = $bought_folders;
            $data['free_folders'] = $free_folders;
            $data['folders'] = $fd = Folder::whereIn('id', $bought_and_free_folders)->get();
            $data['master_classes'] = MasterClass::whereIn('id', $my_classes_arr)->with(['cover', 'class_his'])->get();
            $data['materials'] = $mm = DB::table('material_histories')
                ->join('materials', 'material_histories.material_id', '=', 'materials.id')
                ->join('material_types', 'materials.material_type_id', '=', 'material_types.id')
                // ->join('folders', 'materials.folder_id', '=', 'folders.id')
                ->join('files', 'materials.material_cover_id', '=', 'files.id')
                ->select('material_histories.id as mat_his_id', 'material_histories.is_rent_expired as is_rent_expired', 'material_histories.type as mat_his_type', 'material_histories.unique_id as mat_his_unique_id', 'materials.*', 'files.url as mat_cover', 'material_types.mat_unique_id as mat_unique_id', 'material_types.name as type_name', 'material_types.id as type_id')
                ->whereIn('material_histories.unique_id', $my_materials_arr)
                ->where(['materials.status' => 'active'])
                ->get();
            // dd($mm);
            return View('dashboard.user.library', $data);
        } catch (\Throwable $th) {
            dd($th);
            Session::flash('warning', $th->getMessage());
            return back() ?? redirect()->route('user');
        }
    }

    public function view_folder($id)
    {
        # code...
        try {
            //code...
            $my_materials_arr = [];
            $bought_folders = [];
            $all_my_materials_arr = [];
            if (Auth::user()->team_id) {
                # code...
                $team = Team::find(Auth::user()->team_id);
                foreach ($team->teammates as $key_2 => $value_2) {
                    # code...
                    $user = User::where('email', $value_2)->first();
                    $my_materials = MaterialHistory::where(['user_id' => $user->id, 'is_rent_expired' => false])->get();
                    $all_folders = MaterialHistory::where(['user_id' => $user->id, "mat_type" => "folder", 'isFolderExpired' => false])->get();
                    foreach ($all_folders as $key2 => $value2) {
                        # code...
                        array_push($bought_folders, $value2->folder_id);
                    }
                    foreach ($my_materials as $key => $value) {
                        # code...
                        array_push($my_materials_arr, $value->material_id);
                        array_push($all_my_materials_arr, $value);
                    }
                }
            } else {
                $data['my_materials'] = $my_materials = MaterialHistory::where(['user_id' => Auth::user()->id, 'is_rent_expired' => false])->get();
                $all_folders = MaterialHistory::where(['user_id' => Auth::user()->id, "mat_type" => "folder", 'isFolderExpired' => false])->get();
                foreach ($all_folders as $key2 => $value2) {
                    # code...
                    array_push($bought_folders, $value2->folder_id);
                }
                foreach ($my_materials as $key => $value) {
                    # code...
                    array_push($my_materials_arr, $value->material_id);
                    array_push($all_my_materials_arr, $value);
                }
            }

            $data['my_materials_arr'] = $my_materials_arr;
            $data['all_my_materials_arr'] = $all_my_materials_arr;
            $data['folder'] = $f = Folder::find($id);
            $data['bought_folders'] = $bought_folders;
            $data['folder_mat_count'] = $fmc = Material::where('folder_id', $f->id ?? 0)->count();
            $data['all_materials'] = Material::where(['folder_id' => $id])->with(['type', 'folder', 'mat_his'])->get();
            return View('dashboard.user.view-folder', $data);
        } catch (\Throwable $th) {
            //throw $th;
            Session::flash('warning', $th->getMessage());
            return back() ?? redirect()->route('user');
        }
    }

    public function view_material_type($id)
    {
        # code...
        try {
            //code...
            $data['limit_folder'] = [1, 2, 3, 4];
            $data['type'] = 'Material';
            $MCL = false;
            $data['material_type'] = $mt = MaterialType::where(['id' => $id])->first();
            if (!$mt) {
                # code...
                Session::flash('warning', "No record found");
                return back();
            }
            if (substr($mt->mat_unique_id, 0, 3) == "CSL"  || substr($mt->mat_unique_id, 0, 3) == "LAW") {
                $data['t_materials'] = $tm = Material::where(['material_type_id' => $mt->id])->with(['type', 'folder', 'mat_his'])->get();
                $data['t_materials'] = $tm->groupBy('folder_id');
                $data['type'] = 'Folder';
            }

            $my_classes_arr = [];
            $all_classes_arr = [];
            $my_materials_arr = [];
            $all_my_materials_arr = [];
            if (Auth::user()->team_id) {
                # code...
                $team = Team::find(Auth::user()->team_id);
                foreach ($team->teammates as $key_2 => $value_2) {
                    # code...
                    $user = User::where('email', $value_2)->first();

                    $all_classes = MaterialHistory::where(['user_id' => $user->id])->whereNotNull('class_id')->get();
                    foreach ($all_classes as $key3 => $value3) {
                        # code...
                        array_push($my_classes_arr, $value3->class_id);
                        array_push($all_classes_arr, $value3);
                    }


                    $my_materials = MaterialHistory::where(['user_id' => $user->id, 'is_rent_expired' => false])->get();
                    foreach ($my_materials as $key => $value) {
                        # code...
                        array_push($my_materials_arr, $value->material_id);
                        array_push($all_my_materials_arr, $value);
                    }
                }
            } else {
                $all_classes = MaterialHistory::where(['user_id' => Auth::user()->id])->whereNotNull('class_id')->get();
                foreach ($all_classes as $key3 => $value3) {
                    # code...
                    array_push($my_classes_arr, $value3->class_id);
                    array_push($all_classes_arr, $value3);
                }

                $data['my_materials'] = $my_materials = MaterialHistory::where(['user_id' => Auth::user()->id, 'is_rent_expired' => false])->get();
                foreach ($my_materials as $key => $value) {
                    # code...
                    array_push($my_materials_arr, $value->material_id);
                    array_push($all_my_materials_arr, $value);
                }
            }

            $data['my_materials_arr'] = $my_materials_arr;
            $data['all_my_materials_arr'] = $all_my_materials_arr;
            $data['my_classes_arr'] = $my_classes_arr;
            $data['all_classes_arr'] = $all_classes_arr;

            $data['materials'] = $m = Material::where(['material_type_id' => $mt->id])->with(['type', 'folder', 'mat_his'])->get();
            $data['master_classes'] = MasterClass::with(['cover', 'class_his'])->get();


            if (substr($mt->mat_unique_id, 0, 3) == "MCL") {
                $MCL = true;
            }

            if (substr($mt->mat_unique_id, 0, 3) == "TAA") {
                $data['materials'] = $m = Material::where(['material_type_id' => $mt->id, 'university_id' => Auth::user()->university_id])->with(['type', 'folder', 'mat_his'])->get();
            }

            $data['MCL'] = $MCL;
            $data['title'] = $mt->name;
            return View('dashboard.user.view-all-material-type', $data);
        } catch (\Throwable $th) {
            //throw $th;
            Session::flash('warning', $th->getMessage());
            return back() ?? redirect()->route('user');
        }
    }

    public function view_class($id)
    {
        $object = new \stdClass();

        try {
            //code...
            $data['status'] = true;
            $data['class'] = $class = MasterClass::where('id', $id)->with('cover')->first();
            if (!$class) {
                $object->status = false;
                $object->msg = "No record found";
                $data['response'] = $object;
                return View('dashboard.user.classes.view', $data);
            }
            $object->status = true;
            $meetings_arr = [];
            $details = $class->details;
            if (is_array($details)) {
                foreach ($details as $detail) {
                    if (!empty($detail['meeting_id'])) {
                        $meeting_details = Meeting::where('id', $detail['meeting_id'])->first();
                        $obj = new \stdClass();
                        $obj->id = $detail['id'];
                        $obj->date = $detail['date'];
                        $obj->meeting_id = $detail['meeting_id'];
                        $obj->meeting = $meeting_details;
                        array_push($meetings_arr, $obj);
                    }
                }
            }

            // Check for all the bought/owned classes
            $my_classes_arr = [];
            $all_classes_arr = [];
            if (Auth::user()->team_id) {
                # code...
                $team = Team::find(Auth::user()->team_id);
                foreach ($team->teammates as $key_2 => $value_2) {
                    # code...
                    $user = User::where('email', $value_2)->first();
                    $all_classes = MaterialHistory::where(['user_id' => $user->id])->whereNotNull('class_id')->get();
                    foreach ($all_classes as $key3 => $value3) {
                        # code...
                        array_push($all_classes_arr, $value3->class_id);
                    }
                    // }
                }
            } else {
                $all_classes = MaterialHistory::where(['user_id' => Auth::user()->id])->whereNotNull('class_id')->get();
                foreach ($all_classes as $key3 => $value3) {
                    # code...
                    array_push($all_classes_arr, $value3->class_id);
                }
            }

            $data['response'] = $object;
            $data['meetings_arr'] = $meetings_arr;
            $data['all_classes_arr'] = $all_classes_arr;
            $data['my_classes_arr'] = $my_classes_arr;
            return View('dashboard.user.classes.view', $data);
        } catch (\Throwable $th) {
            $object->status = false;
            // $object->msg = false;
            $object->msg = "Something went wrong, try again!";
            $data['response'] = $object;
            return View('dashboard.user.classes.view', $data);
            
            Session::flash('warning', $th->getMessage());
            return back() ?? redirect()->route('user');
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
            $data['status'] = true;
            $my_materials_arr = [];
            $bought_folders = [];
            if (Auth::user()->team_id) {
                # code...
                $team = Team::find(Auth::user()->team_id);
                foreach ($team->teammates as $key_2 => $value_2) {
                    # code...
                    $user = User::where('email', $value_2)->first();
                    $my_materials = MaterialHistory::where(['user_id' => $user->id, 'is_rent_expired' => false])->get();
                    $all_folders = MaterialHistory::where(['user_id' => $user->id, "mat_type" => "folder", 'isFolderExpired' => false])->get();
                    $all_classes = MaterialHistory::where(['user_id' => $user->id])->whereNotNull('class_id')->get();
                    foreach ($all_folders as $key2 => $value2) {
                        # code...
                        array_push($bought_folders, $value2->folder_id);
                    }
                    foreach ($my_materials as $key => $value) {
                        # code...
                        array_push($my_materials_arr, $value->material_id);
                    }
                }
            } else {
                $all_classes = MaterialHistory::where(['user_id' => Auth::user()->id])->whereNotNull('class_id')->get();
                $data['my_materials'] = $my_materials = MaterialHistory::where(['user_id' => Auth::user()->id, 'is_rent_expired' => false])->get();
                $all_folders = MaterialHistory::where(['user_id' => Auth::user()->id, "mat_type" => "folder", 'isFolderExpired' => false])->get();
                foreach ($all_folders as $key2 => $value2) {
                    # code...
                    array_push($bought_folders, $value2->folder_id);
                }
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
                $data['status'] = false;
                Session::flash('warning', "No material found");
                return back();
            }
            $data['typeName'] = '';
            $data['rentedMatCount'] = $rentedMatCount = MaterialHistory::where(['user_id' => Auth::user()->id, 'is_rent_expired' => false, 'type' => 'rented'])->get()->count();
            // dd($bought_folders);
            if ($m->file) {
                $data['pageCount'] = countPages(public_path($m->file->url));
            }
            if ($m->citation == "new_meeting") {
                $data['meeting'] = Meeting::find($m->publisher);
            } else {
                $data['meeting'] = [];
            }
            $data['pageCount'] = 0;
            $data['folder'] = $f = Folder::find($m->folder_id);
            $data['bought_folders'] = $bought_folders;
            $data['folder_mat_count'] = $fmc = Material::where('folder_id', $f->id ?? 0)->count();
            return View('dashboard.user.view', $data);
        } catch (\Throwable $th) {
            throw $th;
            Session::flash('warning', $th->getMessage());
            return back() ?? redirect()->route('user');
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
            Session::flash('warning', $th->getMessage());
            return back() ?? redirect()->route('user');
        }
    }

    public function view_transaction($id)
    {
        # code...
        try {
            $data['status'] = false;
            $data['tran'] = $tran = Transaction::where(['id' => $id, 'user_id' => Auth::user()->id])->with(['user'])->first();
            if ($tran) {
                $data['status'] = true;
            }
            if ($tran->subscription_id) {
                $data['sub'] = Subscription::find($tran->subscription_id);
            }
            if ($tran->type == "rented" || $tran->type == "bought") {
                $data['mat_his'] = $mat_his = MaterialHistory::where(['invoice_id' => $tran->transaction_id, 'user_id' => Auth::user()->id])->with(['mat'])->get('material_id')->first();
            }
            return View('dashboard.user.view-transaction', $data);
        } catch (\Throwable $th) {
            Session::flash('warning', $th->getMessage());
            return back() ?? redirect()->route('admin');
            dd($th->getMessage());
            //throw $th;
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
            Session::flash('warning', $th->getMessage());
            return back() ?? redirect()->route('user');
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
                'currency_id' => Auth::user()->currency->id,
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

            $data['user'] = User::where('id', Auth::user()->id)->update(['sub_id' => $save_sub->id, 'team_id' => $team_id ?? null]);

            return $data;
        } catch (\Throwable $th) {
            //throw $th;
            return false;
            Session::flash('warning', $th->getMessage());
            return back() ?? redirect()->route('user');
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
            Session::flash('warning', $th->getMessage());
            return back() ?? redirect()->route('user');
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
            Session::flash('warning', $th->getMessage());
            return back() ?? redirect()->route('user');
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
            Session::flash('warning', $th->getMessage());
            return back() ?? redirect()->route('user');
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
            Session::flash('warning', $th->getMessage());
            return back() ?? redirect()->route('user');
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
            $folder_id = null;
            $mat_type = "material";
            $rent_unique_id = 0;
            if ($type == "rented") {
                # code...
                //Rent duration
                $RENTED_DAYS = \getenv('RENTED_DAYS');
                $date_rented_expired = Carbon::now()->addDays($RENTED_DAYS);
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

            $trans = Transaction::create([
                'user_id' => Auth::user()->id,
                'invoice_id' => $invoice_id,
                'date' => $date,
                'amount' => $amount,
                'status' => $status,
                'currency_id' => Auth::user()->currency->id,
                'reference' => $reference,
                'trxref' => $trxref,
                'type' =>  $type
            ]);

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

            return $data;
        } catch (\Throwable $th) {
            Session::flash('warning', $th->getMessage());
            return back() ?? redirect()->route('user');
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
            Session::flash('warning', $th->getMessage());
            return back() ?? redirect()->route('user');
            //throw $th;
        }
    }

    public function add_free_folder_to_library($id)
    {
        # code...
        try {
            //code...
            $folder = Folder::find($id);

            if (!$folder) {
                Session::flash('warning', 'Folder not found');
                return back();
            }

            MaterialHistory::create([
                'user_id' => Auth::user()->id,
                'material_id' => null,
                'unique_id' => Str::upper("FOLD" . $this->unique_code(12)),
                'transaction_id' => null,
                'date' =>  Carbon::now(),
                'folder_id' =>  $folder->id,
                'mat_type' => 'folder',
                'type' => 'free'
            ]);

            Session::flash('success', 'Material added to my library successfully');
            return redirect()->route('user.library');
        } catch (\Throwable $th) {
            Session::flash('warning', $th->getMessage());
            return back() ?? redirect()->route('user');
            //throw $th;
        }
    }

    public function add_to_library($id)
    {
        # code...
        try {
            //code...
            $material = Material::find($id);

            if (!$material) {
                Session::flash('warning', 'Material not found');
                return redirect()->route('user.library');
            }

            MaterialHistory::create([
                'user_id' => Auth::user()->id,
                'material_id' => $material->id,
                'unique_id' => Str::upper("MATHIS" . $this->unique_code(12)),
                'transaction_id' => null,
                'date' =>  Carbon::now(),
                'type' => 'free'
            ]);

            Session::flash('success', 'Material added to my library successfully');
            return redirect()->route('user.library');
        } catch (\Throwable $th) {
            Session::flash('warning', $th->getMessage());
            return back() ?? redirect()->route('user');
            //throw $th;
        }
    }

    public function add_masterclass_to_library($id)
    {
        # code...
        try {
            //code...
            $class = MasterClass::find($id);

            if (!$class) {
                Session::flash('warning', 'Master Class not found');
                return redirect()->route('user.library');
            }
            $params = [
                'user_id' => Auth::user()->id,
                'class_id' => $class->id,
                // 'unique_id' => Str::upper("MATHIS" . $this->unique_code(12)),
                'transaction_id' => null,
                'date' =>  Carbon::now(),
                'type' => 'free'
            ];

            // dd($class, $params);
            MaterialHistory::create($params);

            Session::flash('success', 'Master Class added to my library successfully');
            return redirect()->route('user.library');
        } catch (\Throwable $th) {
            dd($th);
            Session::flash('warning', $th->getMessage());
            return back() ?? redirect()->route('user');
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
            }
            //  else {
            //     $note = Note::where(['material_id' => $id, 'user_id' => Auth::user()->id])->first();
            // }

            if (isset($note)) {
                Session::put('current_note', $note->id);
            }
            $data['note'] = $note;
            $data['current_note'] = $current_note;
            $data['notes'] = Note::where(['user_id' => Auth::user()->id])->orderBy('id', 'DESC')->get();

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

                // return $data;
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
            Session::flash('warning', $th->getMessage());
            return back() ?? redirect()->route('user');
            //throw $th;
        }
    }

    public function delete_note(Request $request)
    {

        try {
            //code...
            $id = $request->note_id;
            $note = Note::where(['user_id' => Auth::user()->id, 'id' => $id])->first();
            $note->delete();
            if ($note) {
                return true;
            } else {
                return false;
            }
        } catch (\Throwable $th) {
            return false;
            Session::flash('warning', $th->getMessage());
            return back() ?? redirect()->route('user');
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
            $data['found_note'] = true;

            if (!$note) {
                // Session::flash('warning', 'No note found');
                $data['found_note'] = false;
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
            Session::flash('warning', $th->getMessage());
            return back() ?? redirect()->route('user');
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
        if ($invite) {
            $invite->status = 'accept';
            $invite->date_accepted = Carbon::now();
            $invite->save();
            Session::flash('success', 'Invite Accepted');
        }
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
            Session::flash('warning', $th->getMessage());
            return back() ?? redirect()->route('user');
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
            Session::flash('warning', $th->getMessage());
            return back() ?? redirect()->route('user');
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
            Session::flash('warning', $th->getMessage());
            return back() ?? redirect()->route('user');
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
            Session::flash('warning', $th->getMessage());
            return back() ?? redirect()->route('user');
            //throw $th;
        }
    }

    public function change_password(Request $request)
    {
        try {
            if ($_POST) {
                $rules = array(
                    'current_password'     => ['nullable', 'string', 'max:20'],
                    'new_password'  => ['required_with:current_password', 'nullable', 'min:8', 'max:16', 'regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/', 'regex:/[@$!%*#?&+-]/', 'same:confirm_new_password',],
                    'confirm_new_password' => ['nullable']
                );

                $customMessages = [
                    'new_password.required_with' => 'The :attribute field is required.',
                    'new_password.min' => 'The :attribute must be at least 8 characters.',
                    'new_password.max' => 'The :attribute must not more than 16 characters.',
                    'new_password.regex' => 'The :attribute must include at least one uppercase, one lowercase, one number, and a special character.',
                    'new_password.required_with' => 'The :attribute field is required.',
                    'new_password.same' => 'The new password and confirm password must match',
                ];

                $validator = Validator::make($request->all(), $rules, $customMessages);

                if ($validator->fails()) {
                    Session::flash('warning', __('All fields are required'));
                    return back()->withErrors($validator)->withInput();
                }

                if ($request->current_password) {
                    # code...
                    $current_password = Auth::user()->password;
                    if (!Hash::check($request->current_password, $current_password)) {
                        Session::flash(__('warning'), __('Incorrect Password'));
                        return back()->withErrors(['current_password' => __('The current password is incorrect')]);
                    }
                }

                $update_user = User::where('id', Auth::user()->id)->first();
                $update_user->password = Hash::make($request->new_password);
                $update_user->save();

                if (!$update_user) {
                    # code...
                    Session::flash('error', "An error occur when update profile, try again");
                    return back();
                }


                Session::flash('success', "Password changed successfully");
                return back();
            }

            $data = [];
            return View('dashboard.user.change-password', $data);
        } catch (\Throwable $th) {
            Session::flash('warning', $th->getMessage());
            return back() ?? redirect()->route('user');
        }
    }
}