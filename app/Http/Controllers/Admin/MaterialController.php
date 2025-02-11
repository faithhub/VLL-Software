<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\File;
use App\Models\Folder;
use App\Models\Material;
use App\Models\MaterialHistory;
use App\Models\MaterialType;
use App\Models\Subject;
use App\Models\University;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Image;

class MaterialController extends Controller
{

    public function library()
    {
        # code...
        try {
            //code...
            $data['title'] = "All Materials";
            $data['sn'] = 1;
            $data['materials'] = Material::with(['type', 'file', 'cover', 'vendor'])->orderBy('created_at', 'DESC')->get();
            return View('dashboard.admin.library.index', $data);
        } catch (\Throwable $th) {
            Session::flash('warning', $th->getMessage());
            return back() ?? redirect()->route('admin');
            Session::flash('warning', $th->getMessage());
            return back() ?? redirect()->route('admin');
            dd($th->getMessage());
            //throw $th;
        }
    }

    public function folders()
    {
        # code...
        try {
            //code...
            $data['title'] = "Admin Dashboard - All Folder";
            $data['sn'] = 1;
            // $data['folders'] = $f = Folder::where(['user_id' => Auth::user()->id])->with('mat_type')->orderBy('id', 'DESC')->get();
            $data['folders'] = $f = Folder::with(['mat_type', 'user'])->orderBy('id', 'DESC')->get();
            return View('dashboard.admin.library.folders', $data);
        } catch (\Throwable $th) {
            Session::flash('warning', $th->getMessage());
            return back() ?? redirect()->route('admin');
            Session::flash('warning', $th->getMessage());
            return back() ?? redirect()->route('admin');
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
                    'amount' => ['required', 'string', 'max:255'],
                    'folder_cover_id' => ['required', 'mimes:jpeg,png,jpg,gif,svg', 'max:50000'],
                );

                $messages = [
                    'folder_cover_id.required_if' => __('The Folder cover is required'),
                ];

                // dd($request->all());
                $validator = Validator::make($request->all(), $rules, $messages);

                if ($validator->fails()) {
                    Session::flash('warning', __('All fields are required'));
                    return back()->withErrors($validator)->withInput();
                }

                if ($request->hasFile('folder_cover_id')) {
                    $folder_cover = $request->file('folder_cover_id');
                    $folder_cover_name = 'FolderCover' . time() . '.' . $folder_cover->getClientOriginalExtension();
                    $destinationPath = public_path('/storage/materials/covers');
                    if (!file_exists($destinationPath)) {
                        mkdir($destinationPath, 777, true);
                    }
                    $img = Image::make($folder_cover->path());



                    // $img->resize(600, 300, function ($constraint) {
                    //     $constraint->aspectRatio();
                    // })->save($destinationPath . '/' . $folder_cover_name);


                    $img->resize(600, 300, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save(public_path('/storage/materials/covers/' . $folder_cover_name));


                    $save_cover = File::create([
                        'name' => $folder_cover_name,
                        'url' => 'storage/materials/covers/' . $folder_cover_name
                    ]);
                }

                $tags = explode(",", $request->tags);

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
                    "user_id" => Auth::user()->id
                ]);
                Session::flash('success', __('Folder added successfully'));
                return redirect()->back();
            }

            $data['title'] = "Create New Folder";
            $data['mode'] = "create";
            $role = ['admin'];
            $data['material_types'] = $m = MaterialType::where("status", "active")->whereIn('name', ['Law', 'Case Law'])->whereJsonContains('role', $role)->get();
            $data['subjects'] = Subject::where("status", "active")->get();
            $data['countries'] = Country::all();
            // $material_type_id = MaterialType::where(["status" => "active"])->whereIn('mat_unique_id', ['CSL786746357', 'LAW9889734678'])->whereJsonContains('role', $role)->get();
            $data['folders'] = $f = Folder::where(['user_id' => Auth::user()->id])->get();
            $data['universities'] = University::Orderby('name', 'ASC')->get();
            return View('dashboard.admin.modals.add-folder', $data);
        } catch (\Throwable $th) {
            Session::flash('warning', $th->getMessage());
            return back() ?? redirect()->route('admin');
            Session::flash('warning', $th->getMessage());
            return back() ?? redirect()->route('admin');
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
            $data['title'] = "Admin Dashboard - Materials";
            $data['all_materials'] = Material::where(['folder_id' => $id])->with(['type', 'folder'])->get();
            // $data['all_materials'] = Material::where(['user_id' => Auth::user()->id, 'folder_id' => $id])->with(['type', 'folder'])->get();
            return View('dashboard.admin.modals.view-folder', $data);
        } catch (\Throwable $th) {
            Session::flash('warning', $th->getMessage());
            return back() ?? redirect()->route('admin');
            Session::flash('warning', $th->getMessage());
            return back() ?? redirect()->route('admin');
            //throw $th;
            dd($th->getMessage());
        }
    }

    public function delete_folder($id)
    {
        # code...
        try {
            //code...
            $folder = Folder::where(['id' => $id])->first();
            // $folder = Folder::where(['user_id' => Auth::user()->id, 'id' => $id])->first();
            if (!$folder) {
                Session::flash('warning', 'No record found for this folder');
                return redirect()->back();
            }
            $folder->delete();
            Session::flash('success', 'Folder deleted successfully');
            return redirect()->route('admin.folders');
        } catch (\Throwable $th) {
            Session::flash('warning', $th->getMessage());
            return back() ?? redirect()->route('admin');
            Session::flash('warning', $th->getMessage());
            return back() ?? redirect()->route('admin');
            dD($th->getMessage());
            //throw $th;
        }
    }

    public function edit_folder(Request $request, $id)
    {
        # code...
        try {
            $data['folder'] = $folder = Folder::where(['id' => $id])->first();
            // $data['folder'] = $folder = Folder::where(['user_id' => Auth::user()->id, 'id' => $id])->first();

            if (!$folder) {
                Session::flash('warning', __('No record found'));
                return redirect()->route('admin.folders');
            }
            //code...
            if ($_POST) {
                $rules = array(
                    // unique:users,email,'.$this->user->id
                    'name' => ['required', 'string', 'unique:folders,name,' . $id],
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
                    Session::flash('warning', __('All fields are required'));
                    // dd($validator->errors(), $request->all(), $id);
                    return back()->withErrors($validator)->withInput();
                }

                if ($request->hasFile('folder_cover_id')) {
                    $folder_cover = $request->file('folder_cover_id');
                    $folder_cover_name = 'FolderCover' . time() . '.' . $folder_cover->getClientOriginalExtension();
                    $destinationPath = public_path('/storage/materials/covers');
                    if (!file_exists($destinationPath)) {
                        mkdir($destinationPath, 777, true);
                    }
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

                // Folder::where(['user_id' => Auth::user()->id, 'id' => $id])->update([
                Folder::where(['id' => $id])->update([
                    "material_type_id" => $request->material_type_id,
                    "name" => $request->name,
                    "name_of_author" => $request->name_of_author,
                    "version" => $request->version,
                    "country_id" => $request->country_id,
                    "publisher" => $request->publisher,
                    "tags" => $tags,
                    "amount" => $request->amount ?? $folder->amount,
                    "duration" => $request->duration ?? $folder->duration,
                    "folder_cover_id" => $save_cover->id ?? $folder->folder_cover_id,
                ]);
                Session::flash('success', __('Folder updated successfully'));
                return redirect()->route('admin.folders');
            }
            $role = ['admin'];
            $data['material_types'] = $m = MaterialType::where("status", "active")->whereIn('name', ['Law', 'Case Law'])->whereJsonContains('role', $role)->get();
            $data['title'] = "Admin Dashboard - Edit Folder";
            $data['mode'] = "edit";
            $data['countries'] = Country::all();
            return View('dashboard.admin.modals.add-folder', $data);
        } catch (\Throwable $th) {
            Session::flash('warning', $th->getMessage());
            return back() ?? redirect()->route('admin');
            Session::flash('warning', $th->getMessage());
            return back() ?? redirect()->route('admin');
            dD($th->getMessage());
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
                    // dd("new_folder", $request->all());
                } elseif ($request->folder_id != null && $request->folder_id != "new_folder") {
                    if ($request->material_type_value == "CSL") {
                        $rules = array(
                            // 'material_type_id' => ['required', 'string', 'max:255'],
                            'folder_id' => ['required', 'string', 'max:255'],
                            'citation' => ['required', 'string', 'max:255'],
                            // 'folder_name' => ['required', 'string', 'max:255'],
                            'name_of_party' => ['required', 'string', 'max:255'],
                            // 'name_of_author' => ['required', 'string', 'max:255'],
                            'name_of_court' => ['required', 'string', 'max:255'],
                            'tags' => ['required', 'string', 'max:255'],
                            'material_file_id' => ['required', 'mimes:pdf,mp4,mov,ogg,qt', 'max:50000'],
                        );
                    }
                    if ($request->material_type_value == "LAW") {
                        $rules = array(
                            // 'material_type_id' => ['required', 'string', 'max:255'],
                            'folder_id' => ['required', 'string', 'max:255'],
                            // 'folder_name' => ['required', 'string', 'max:255'],
                            'title' => ['required', 'string', 'max:255'],
                            'year_of_enactmen' => ['required', 'string', 'max:255'],
                            'tags' => ['required', 'max:255'],
                            'material_file_id' => ['required', 'mimes:pdf,mp4,mov,ogg,qt', 'max:50000'],
                        );
                    }
                    // dd("not new_folder", $request->all());
                } else {
                    // dd("not new_folder", $request->all());
                    $rules = array(
                        'title' => ['required', 'string', 'max:255'],
                        // 'name_of_author' => ['required', 'string', 'max:255'],
                        'name_of_author' => ['required_if:material_type_value,TXT,LOJ,VAA,LAW'],
                        'version' => ['required_if:material_type_value,TXT,LOJ,VAA,LAW'],
                        // 'version' => ['required', 'string', 'max:255'],
                        'year_of_publication' => ['required_if:material_type_value,TXT,LOJ,TAA,VAA'],
                        'price' => ['required_if:material_type_value,TXT,LOJ,TAA,VAA'],
                        'amount' => ['required_if:price,Paid'],
                        'material_type_id' => ['required', 'max:255'],
                        'folder_id' => ['required_if:material_type_value,CSL,LAW'],
                        'name_of_party' => ['required_if:material_type_value,CSL'],
                        // 'name_of_court' => ['required_if:material_type_value,CSL'],
                        'citation' => ['required_if:material_type_value,CSL'],
                        // 'year_of_publication' => ['required_if:material_type_value,TXT,LOJ,CSL,LAW,VAA'],
                        'country_id' => ['required_if:material_type_value,TXT,LOJ,CSL,VAA,LAW'],
                        'test_country_id' => ['required_if:material_type_value,TAA'],
                        'university_id' => ['required_if:material_type_value,TAA'],
                        // 'publisher' => ['required', 'string', 'max:255'],
                        'publisher' => ['required_if:material_type_value,TXT,LOJ,VAA'],
                        'tags' => ['required', 'string', 'max:255'],
                        'subject_id' => ['required_if:material_type_value,TXT'],
                        'privacy_code' => ['required_if:material_type_value,TAA'],
                        // 'material_file_id.*' => ['required', 'mimes:pdf', 'max:100'],
                        'material_file_id' => ['required', 'mimes:pdf,mp4,mp3,mov,ogg,qt', 'max:50000'],
                        'material_cover_id' => ['required_if:material_type_value,TXT,LOJ,VAA', 'mimes:jpeg,png,jpg,gif,svg', 'max:5000'],
                        'material_desc' => ['required_if:material_type_value,TXT,LOJ,VAA'],
                        'terms' => ['required', 'max:255']
                    );
                    // dd("all", $request->all());
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

                if ($request->hasFile('material_cover_id')) {
                    $material_cover = $request->file('material_cover_id');
                    $material_cover_name = 'MaterialCover' . time() . '.' . $material_cover->getClientOriginalExtension();
                    Storage::disk('material_cover')->put($material_cover_name, file_get_contents($material_cover));
                    $save_cover = File::create([
                        'name' => $material_cover_name,
                        'url' => 'storage/materials/covers/' . $material_cover_name
                    ]);
                }


                if ($request->hasFile('folder_cover_id')) {
                    $folder_cover = $request->file('folder_cover_id');
                    $folder_cover_name = 'FolderCover' . time() . '.' . $folder_cover->getClientOriginalExtension();
                    $destinationPath = public_path('/storage/materials/covers');
                    if (!file_exists($destinationPath)) {
                        mkdir($destinationPath, 777, true);
                    }
                    $img = Image::make($folder_cover->path());
                    
                    // $img->resize(600, 300, function ($constraint) {
                    //     $constraint->aspectRatio();
                    // })->save($destinationPath . '/' . $folder_cover_name);

                    $img->resize(600, 300, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save(public_path('/storage/materials/covers/' . $folder_cover_name));

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

                    // dd($request->all());
                    $folder = null;
                    if (
                        $request->material_type_value == "CSL" || $request->material_type_value == "LAW"
                    ) {
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
                        'version' => $request->version ?? null,
                        'price' => $request->price ?? null,
                        'amount' => $request->amount ?? null,
                        "country_id" => $request->country_id,
                        'material_type_id' => $request->material_type_id ?? $folder->material_type_id,
                        'folder_id' => $request->folder_id ?? null,
                        'year_of_enactmen' => $request->year_of_enactmen ?? null,
                        'year_of_publication' => $request->year_of_publication ?? null,
                        'test_country_id' => $request->test_country_id ?? null,
                        'university_id' => $request->university_id ?? null,
                        'country_id' => $request->country_id ?? null,
                        'publisher' => $request->publisher ?? null,
                        'tags' => $tags,
                        'uploaded_by' => 'admin',
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
                    return redirect()->route('admin.library');
                }
            }

            $data['title'] = "Upload Material";
            $data['ff_csl'] = false;
            $ff_csl_arr = [];
            $data['ff_law'] = false;
            $ff_law_arr = [];
            $role = ['admin'];
            $data['material_types'] = $m = MaterialType::where("status", "active")->whereJsonContains('role', $role)->get();
            $data['subjects'] = Subject::where("status", "active")->get();
            $data['countries'] = Country::all();
            // $material_type_id = MaterialType::where(["status" => "active"])->whereIn('mat_unique_id', ['CSL786746357', 'LAW9889734678'])->whereJsonContains('role', $role)->get();
            $data['folders'] = $f = Folder::where(['user_id' => Auth::user()->id])->with('mat_type')->get();
            foreach ($f as $key => $value) {
                # code...
                if (isset($value->mat_type->mat_unique_id)) {
                    if (
                        substr($value->mat_type->mat_unique_id, 0, 3) == "CSL"
                    ) {
                        array_push($ff_csl_arr, $value);
                        $data['ff_csl'] = true;
                    }
                    if (
                        substr($value->mat_type->mat_unique_id, 0, 3) == "LAW"
                    ) {
                        array_push($ff_law_arr, $value);
                        $data['ff_law'] = true;
                    }
                }
            }
            $data['ff_csl_arr'] = $ff_csl_arr;
            $data['ff_law_arr'] = $ff_law_arr;
            $data['universities'] = University::Orderby('name', 'ASC')->get();
            return View('dashboard.admin.library.upload', $data);
        } catch (\Throwable $th) {
            Session::flash('warning', $th->getMessage());
            return back() ?? redirect()->route('admin');
            Session::flash('warning', $th->getMessage());
            return back() ?? redirect()->route('admin');
            dd($th->getMessage());
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
            Session::flash('success', __('Canceled successfully'));
            return redirect()->route('admin.upload');
        } catch (\Throwable $th) {
            Session::flash('warning', $th->getMessage());
            return back() ?? redirect()->route('admin');
            Session::flash('warning', $th->getMessage());
            return back() ?? redirect()->route('admin');
            dd($th->getMessage());
            //throw $th;
        }
    }

    public function delete($id)
    {
        # code...
        try {
            //code...
            $material =   Material::find($id);
            if (!$material) {
                Session::flash('error', __('Not record found'));
                return redirect()->withInput(['tabName' => 'subjects']);
            }
            $material->delete();
            Session::flash('success', __('Material Type deleted successfully'));
            return redirect()->back();
        } catch (\Throwable $th) {
            Session::flash('warning', $th->getMessage());
            return back() ?? redirect()->route('admin');
            Session::flash('warning', $th->getMessage());
            return back() ?? redirect()->route('admin');
            dd($th->getMessage());
            //throw $th;
        }
    }

    public function edit(Request $request, $id)
    {
        # code...
        try {
            $data['mode'] = "edit";
            //code...
            if ($_POST) {
                $material = Material::find($request->id);
                if (!$material) {
                    Session::flash('warning', 'No record found for this material');
                    return redirect()->back();
                }


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
                    // dd("new_folder", $request->all());
                } elseif ($request->folder_id != null && $request->folder_id != "new_folder") {
                    if ($request->material_type_value == "CSL") {
                        $rules = array(
                            // 'material_type_id' => ['required', 'string', 'max:255'],
                            'folder_id' => ['required', 'string', 'max:255'],
                            'citation' => ['required', 'string', 'max:255'],
                            // 'folder_name' => ['required', 'string', 'max:255'],
                            'name_of_party' => ['required', 'string', 'max:255'],
                            // 'name_of_author' => ['required', 'string', 'max:255'],
                            'name_of_court' => ['required', 'string', 'max:255'],
                            'tags' => ['required', 'string', 'max:255'],
                            'material_file_id' => ['required', 'mimes:pdf,mp4,mov,ogg,qt', 'max:50000'],
                        );
                    }
                    if ($request->material_type_value == "LAW") {
                        $rules = array(
                            // 'material_type_id' => ['required', 'string', 'max:255'],
                            'folder_id' => ['required', 'string', 'max:255'],
                            // 'folder_name' => ['required', 'string', 'max:255'],
                            'title' => ['required', 'string', 'max:255'],
                            'year_of_enactmen' => ['required', 'string', 'max:255'],
                            'tags' => ['required', 'max:255'],
                            'material_file_id' => ['required', 'mimes:pdf,mp4,mov,ogg,qt', 'max:50000'],
                        );
                    }
                } else {
                    // dd("not new_folder", $request->all());
                    $rules = array(
                        'title' => ['required', 'string', 'max:255'],
                        // 'name_of_author' => ['required', 'string', 'max:255'],
                        'name_of_author' => ['required_if:material_type_value,TXT,LOJ,VAA,LAW'],
                        'version' => ['required_if:material_type_value,TXT,LOJ,VAA,LAW'],
                        // 'version' => ['required', 'string', 'max:255'],
                        'year_of_publication' => ['required_if:material_type_value,TXT,LOJ,TAA,VAA'],
                        'price' => ['required_if:material_type_value,TXT,LOJ,TAA,VAA'],
                        'amount' => ['required_if:price,Paid'],
                        'material_type_id' => ['required', 'max:255'],
                        'folder_id' => ['required_if:material_type_value,CSL,LAW'],
                        'name_of_party' => ['required_if:material_type_value,CSL'],
                        // 'name_of_court' => ['required_if:material_type_value,CSL'],
                        'citation' => ['required_if:material_type_value,CSL'],
                        // 'year_of_publication' => ['required_if:material_type_value,TXT,LOJ,CSL,LAW,VAA'],
                        'country_id' => ['required_if:material_type_value,TXT,LOJ,CSL,VAA,LAW'],
                        'test_country_id' => ['required_if:material_type_value,TAA'],
                        'university_id' => ['required_if:material_type_value,TAA'],
                        // 'publisher' => ['required', 'string', 'max:255'],
                        'publisher' => ['required_if:material_type_value,TXT,LOJ,VAA'],
                        'tags' => ['required', 'string', 'max:255'],
                        'subject_id' => ['required_if:material_type_value,TXT'],
                        'privacy_code' => ['required_if:material_type_value,TAA'],
                        // 'material_file_id.*' => ['required', 'mimes:pdf', 'max:100'],
                        // 'material_file_id' => ['required', 'mimes:pdf,mp4,mp3,mov,ogg,qt', 'max:50000'],
                        // 'material_cover_id' => ['required_if:material_type_value,TXT,LOJ,VAA', 'mimes:jpeg,png,jpg,gif,svg', 'max:5000'],
                        'material_file_id' => ['mimes:pdf,mp4,mp3,mov,ogg,qt', 'max:50000'],
                        'material_cover_id' => ['mimes:jpeg,png,jpg,gif,svg', 'max:5000'],
                        'material_desc' => ['required_if:material_type_value,TXT,LOJ,VAA'],
                        // 'terms' => ['required', 'max:255']
                    );
                    // dd("all", $request->all());
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

                if ($request->hasFile('material_cover_id')) {
                    $material_cover = $request->file('material_cover_id');
                    $material_cover_name = 'MaterialCover' . time() . '.' . $material_cover->getClientOriginalExtension();
                    $destinationPath = public_path('/storage/materials/covers');

                    if (!file_exists($destinationPath)) {
                        mkdir($destinationPath, 777, true);
                    }

                    $img = Image::make($material_cover->path());

                    $img->resize(600, 300, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($destinationPath . '/' . $material_cover_name);

                    

                    $save_cover = File::create([
                        'name' => $material_cover_name,
                        'url' => 'storage/materials/covers/' . $material_cover_name
                    ]);
                }

                Material::where(['id' => $request->id])->update([
                    'title' => $request->title ?? $material['title'],
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
                return redirect()->route('admin.library');
            }

            $data['material'] = $material = Material::where(['id' => $id])->with('type')->first();
            if ($material->count() == 0) {
                Session::flash('warning', 'No record found');
                return redirect()->route('admin.library');
            }
            
            $data['title'] = "Edit Material";
            $role = ['admin'];
            $data['material_types'] = $m = MaterialType::where("status", "active")->whereJsonContains('role', $role)->get();
            $data['subjects'] = Subject::where("status", "active")->get();
            $data['countries'] = Country::all();
            $data['folders'] = $f = Folder::all();
            $data['universities'] = University::Orderby('name', 'ASC')->get();
            $data['ff_csl'] = false;
            $data['ff_law'] = false;
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
            // dd($f);
            return View('dashboard.admin.library.edit', $data);
        } catch (\Throwable $th) {
            Session::flash('warning', $th->getMessage());
            return back() ?? redirect()->route('admin');
            Session::flash('warning', $th->getMessage());
            return back() ?? redirect()->route('admin');
            dD($th->getMessage());
            //throw $th;
        }
    }

    public function add_material(Request $request)
    {
        # code...
        try {
            //code...
            $data['title'] = "General Settings";
            if ($_POST) {
                $rules = array(
                    'name' => ['required', 'string', 'max:255'],
                    'description' => ['required', 'string', 'max:255'],
                    'role' => ['required', 'max:255']
                );

                $messages = [];

                $validator = Validator::make($request->all(), $rules, $messages);

                if ($validator->fails()) {
                    Session::flash('warning', __('All fields are required'));
                    return back()->withErrors($validator)->withInput();
                }

                if ($request->id) {
                    // dd($request->all());
                    MaterialType::where('id', $request->id)->update([
                        "name" => $request->name,
                        "description" => $request->description,
                        "role" => $request->role,
                        "status" => $request->status
                    ]);
                    Session::flash('success', __('Material Type updated successfully'));
                    return redirect()->back();
                }

                MaterialType::create([
                    "name" => $request->name,
                    "description" => $request->description,
                    "status" => "active",
                    "role" => $request->role
                ]);
                Session::flash('success', __('Material Type added successfully'));
                return redirect()->back()->withInput(['tabName' => 'materialType']);
            }

            return View('dashboard.admin.modals.create-material', $data);
        } catch (\Throwable $th) {
            Session::flash('warning', $th->getMessage());
            return back() ?? redirect()->route('admin');
            Session::flash('warning', $th->getMessage());
            return back() ?? redirect()->route('admin');
            dd($th->getMessage());
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
            $data['status'] = false;
            $data['material'] = $material = Material::with(['type', 'vendor', 'file', 'cover', 'country', 'subject'])->withTrashed()->find($id);
            if ($material) {
                $data['status'] = true;
                $data['title'] = $material->title;
                $data['histories'] = MaterialHistory::where('material_id', $material->id)->with(['trans', 'user'])->get();
                $data['totalRented'] = MaterialHistory::where(['material_id' => $material->id, 'type' => 'rented'])->get()->count();
                $data['totalBought'] = MaterialHistory::where(['material_id' => $material->id, 'type' => 'bought'])->get()->count();
                $pageCount = 0;
                if ($material->file) {
                    $pageCount = countPages(public_path($material->file->url ?? ""));
                }
                $data['pageCount'] = $pageCount;
                $data['folder'] = $f = Folder::find($material->folder_id);
            }
            return View('dashboard.admin.library.view', $data);
        } catch (\Throwable $th) {
            Session::flash('warning', $th->getMessage());
            return back() ?? redirect()->route('admin');
            dd($th->getMessage());
            //throw $th;
        }
    }

    public function delete_material($id)
    {
        # code...
        try {
            //code...
            $material_type =   MaterialType::find($id);
            if (!$material_type) {
                Session::flash('error', __('Not record found'));
                return redirect()->back()->withInput(['tabName' => 'materialType']);
            }
            $material_type->delete();
            Session::flash('success', __('Material Type deleted successfully'));
            return redirect()->back()->withInput(['tabName' => 'materialType']);
        } catch (\Throwable $th) {
            Session::flash('warning', $th->getMessage());
            return back() ?? redirect()->route('admin');
            dd($th->getMessage());
            //throw $th;
        }
    }

    public function restore_material($id)
    {
        # code...
        try {
            //code...
            $material =   Material::onlyTrashed()->find($id);
            if (!$material) {
                Session::flash('error', __('Not record found'));
                return redirect()->back()->withInput(['tabName' => 'deletedMaterials']);
            }
            $material->restore();
            Session::flash('success', __('Material restored successfully'));
            return redirect()->back()->withInput(['tabName' => 'deletedMaterials']);
        } catch (\Throwable $th) {
            dd($th->getMessage());
            Session::flash('warning', $th->getMessage());
            return back() ?? redirect()->route('admin');
            //throw $th;
        }
    }

    public function restore_material_type($id)
    {
        # code...
        try {
            //code...
            $material_type =   MaterialType::onlyTrashed()->find($id);
            if (!$material_type) {
                Session::flash('error', __('Not record found'));
                return redirect()->back()->withInput(['tabName' => 'deletedMaterialType']);
            }
            $material_type->restore();
            Session::flash('success', __('Material Type restored successfully'));
            return redirect()->back()->withInput(['tabName' => 'deletedMaterialType']);
        } catch (\Throwable $th) {
            Session::flash('warning', $th->getMessage());
            return back() ?? redirect()->route('admin');
            dd($th->getMessage());
            //throw $th;
        }
    }

    public function add_subject(Request $request)
    {
        # code...
        try {
            //code...
            $data['title'] = "General Settings";
            $data['material_types_sub'] = MaterialType::where('status', "active")->get();
            if ($_POST) {
                $rules = array(
                    'material_type' => ['required', 'max:255'],
                    'name' => ['required', 'string', 'max:255'],
                    'description' => ['required', 'string', 'max:255']
                );

                $messages = [];

                $validator = Validator::make($request->all(), $rules, $messages);

                if ($validator->fails()) {
                    Session::flash('warning', __('All fields are required'));
                    return back()->withErrors($validator)->withInput(['tabName' => 'subjects']);;
                }

                if ($request->id) {
                    Subject::where('id', $request->id)->update([
                        "material_type_id" => $request->material_type,
                        "name" => $request->name,
                        "description" => $request->description,
                        "status" => $request->status,
                    ]);
                    Session::flash('success', __('Subject Type updated successfully'));
                    return redirect()->back();
                }

                Subject::create([
                    "material_type_id" => $request->material_type,
                    "name" => $request->name,
                    "description" => $request->description,
                    "status" => "active"
                ]);
                Session::flash('success', __('Subject Type added successfully'));
                return redirect()->back()->withInput(['tabName' => 'subjects']);
            }
            return View('dashboard.admin.modals.create-subject', $data);
        } catch (\Throwable $th) {
            Session::flash('warning', $th->getMessage());
            return back() ?? redirect()->route('admin');
            dd($th->getMessage());
            //throw $th;
        }
    }

    public function view_subject($id)
    {
        # code...
        try {
            //code...
            $data['material_types_sub'] = MaterialType::where('status', "active")->get();
            $data['subject_type'] = $s = $subject_type = Subject::where('id', $id)->with('material')->first();
            // dd($s);
            if (!$subject_type) {
                Session::flash('error', "No record found");
                return redirect()->withInput(['tabName' => 'subjects']);
            }
            return View('dashboard.admin.modals.edit-subject', $data);
        } catch (\Throwable $th) {
            Session::flash('warning', $th->getMessage());
            return back() ?? redirect()->route('admin');
            dd($th->getMessage());
            //throw $th;
        }
    }

    public function delete_subject($id)
    {
        # code...
        try {
            //code...
            $subject_type =   Subject::find($id);
            if (!$subject_type) {
                Session::flash('error', __('Not record found'));
                return redirect()->withInput(['tabName' => 'subjects']);
            }
            $subject_type->delete();
            Session::flash('success', __('Subject Type deleted successfully'));
            return redirect()->withInput(['tabName' => 'subjects']);
        } catch (\Throwable $th) {
            Session::flash('warning', $th->getMessage());
            return back() ?? redirect()->route('admin');
            dd($th->getMessage());
            //throw $th;
        }
    }
}