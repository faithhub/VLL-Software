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
            $data['materials'] = Material::with(['type', 'file', 'cover', 'vendor'])->get();
            return View('dashboard.admin.library.index', $data);
        } catch (\Throwable $th) {
            dd($th->getMessage());
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
                    $img = Image::make($folder_cover->path());
                    $img->resize(600, 300, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($destinationPath . '/' . $folder_cover_name);
                    $save_cover = File::create([
                        'name' => $folder_cover_name,
                        'url' => 'storage/materials/covers/' . $folder_cover_name
                    ]);
                }

                Folder::create([
                    "material_type_id" => $request->material_type_id,
                    "name" => $request->name,
                    "folder_cover_id" => $save_cover->id,
                    "user_id" => Auth::user()->id
                ]);
                Session::flash('success', __('Folder added successfully'));
                return redirect()->back();
            }

            $data['title'] = "Create New Folder";
            $role = ['admin'];
            $data['material_types'] = $m = MaterialType::where("status", "active")->whereIn('name', ['Law', 'Case Law'])->whereJsonContains('role', $role)->get();
            $data['subjects'] = Subject::where("status", "active")->get();
            $data['countries'] = Country::all();
            // $material_type_id = MaterialType::where(["status" => "active"])->whereIn('mat_unique_id', ['CSL786746357', 'LAW9889734678'])->whereJsonContains('role', $role)->get();
            $data['folders'] = $f = Folder::where(['user_id' => Auth::user()->id])->get();
            $data['universities'] = University::Orderby('name', 'ASC')->get();
            return View('dashboard.admin.modals.add-folder', $data);
        } catch (\Throwable $th) {
            dD($th->getMessage());
            //throw $th;
        }
    }

    public function upload(Request $request)
    {
        # code...
        try {
            //code...

            if ($_POST) {
                // dd($request->all());
                $rules = array(
                    'title' => ['required', 'string', 'max:255'],
                    // 'name_of_author' => ['required', 'string', 'max:255'],
                    'name_of_author' => ['required_if:material_type_value,TXT,LOJ,VAA'],
                    'version' => ['required_if:material_type_value,TXT,LOJ,VAA'],
                    // 'version' => ['required', 'string', 'max:255'],
                    'price' => ['required', 'string', 'max:255'],
                    'amount' => ['required_if:price,Paid'],
                    'material_type_id' => ['required', 'max:255'],
                    'folder_id' => ['required_if:material_type_value,CSL'],
                    'name_of_party' => ['required_if:material_type_value,CSL'],
                    'name_of_court' => ['required_if:material_type_value,CSL'],
                    'citation' => ['required_if:material_type_value,CSL'],
                    'year_of_publication' => ['required_if:material_type_value,TXT,LOJ,CSL,VAA'],
                    'country_id' => ['required_if:material_type_value,TXT,LOJ,CSL,VAA'],
                    'test_country_id' => ['required_if:material_type_value,TAA'],
                    'university_id' => ['required_if:material_type_value,TAA'],
                    // 'publisher' => ['required', 'string', 'max:255'],
                    'publisher' => ['required_if:material_type_value,TXT,LOJ,VAA'],
                    'tags' => ['required', 'string', 'max:255'],
                    'subject_id' => ['required_if:material_type_value,5'],
                    'privacy_code' => ['required_if:material_type_value,TAA'],
                    'material_file_id' => ['required', 'mimes:pdf,mp4,mov,ogg,qt', 'max:50000'],
                    'material_cover_id' => ['required', 'mimes:jpeg,png,jpg,gif,svg', 'max:5000'],
                    'material_desc' => ['required'],
                    'terms' => ['required', 'max:255']
                );

                $messages = [
                    'name_of_party.required_if' => __('Name of Party is required'),
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
                    'material_file_id.max' => __('The Material File size must not more than 50MB'),
                    'material_cover_id.required' => __('The Material Cover is required'),
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

                Material::create([
                    'user_id' => Auth::user()->id,
                    'title' => $request->title ?? null,
                    'name_of_author' => $request->name_of_author ?? null,
                    'name_of_court' => $request->name_of_court ?? null,
                    'name_of_party' => $request->name_of_party ?? null,
                    'citation' => $request->citation ?? null,
                    'version' => $request->version ?? null,
                    'price' => $request->price ?? null,
                    'amount' => $request->amount ?? null,
                    'material_type_id' => $request->material_type_id ?? null,
                    'folder_id' => $request->folder_id ?? null,
                    'year_of_publication' => $request->year_of_publication ?? null,
                    'test_country_id' => $request->test_country_id ?? null,
                    'university_id' => $request->university_id ?? null,
                    'country_id' => $request->country_id ?? null,
                    'publisher' => $request->publisher ?? null,
                    'tags' => $tags,
                    'uploaded_by' => 'admin',
                    'subject_id' => $request->subject_id ?? null,
                    'privacy_code' => $request->privacy_code ?? null,
                    'material_file_id' => $save_file->id,
                    'material_cover_id' => $save_cover->id,
                    'material_desc' => $request->material_desc ?? null
                ]);

                Session::flash('success', 'Material uploaded successfully');
                return redirect()->route('admin.library');
            }

            $data['title'] = "Upload Material";
            $role = ['admin'];
            $data['material_types'] = $m = MaterialType::where("status", "active")->whereJsonContains('role', $role)->get();
            $data['subjects'] = Subject::where("status", "active")->get();
            $data['countries'] = Country::all();
            // $material_type_id = MaterialType::where(["status" => "active"])->whereIn('mat_unique_id', ['CSL786746357', 'LAW9889734678'])->whereJsonContains('role', $role)->get();
            $data['folders'] = $f = Folder::where(['user_id' => Auth::user()->id])->get();
            $data['universities'] = University::Orderby('name', 'ASC')->get();
            return View('dashboard.admin.library.upload', $data);
        } catch (\Throwable $th) {
            dd($th->getMessage());
            //throw $th;
        }
    }


    public function edit(Request $request, $id)
    {
        # code...
        try {
            //code...
            if ($_POST) {
                $material = Material::find($request->id);
                if (!$material) {
                    Session::flash('warning', 'No record found for this material');
                    return redirect()->back();
                }
                $rules = array(
                    'title' => ['required', 'string', 'max:255'],
                    'name_of_author' => ['required_if:material_type_value,TXT,LOJ,VAA'],
                    'version' => ['required_if:material_type_value,TXT,LOJ,VAA'],
                    'price' => ['required', 'string', 'max:255'],
                    'amount' => ['required_if:price,Paid'],
                    'material_type_id' => ['required', 'max:255'],
                    'folder_id' => ['required_if:material_type_value,CSL'],
                    'name_of_party' => ['required_if:material_type_value,CSL'],
                    'name_of_court' => ['required_if:material_type_value,CSL'],
                    'citation' => ['required_if:material_type_value,CSL'],
                    'year_of_publication' => ['required_if:material_type_value,TXT,LOJ,CSL,VAA'],
                    'country_id' => ['required_if:material_type_value,TXT,LOJ,CSL,VAA'],
                    'test_country_id' => ['required_if:material_type_value,TAA'],
                    'university_id' => ['required_if:material_type_value,TAA'],
                    'publisher' => ['required', 'string', 'max:255'],
                    'tags' => ['required', 'string', 'max:255'],
                    'subject_id' => ['required_if:material_type_value,5'],
                    'privacy_code' => ['required_if:material_type_value,TAA'],
                    'material_file_id' => ['mimes:pdf,mp4,mov,ogg,qt', 'max:50000'],
                    'material_cover_id' => ['mimes:jpeg,png,jpg,gif,svg', 'max:5000'],
                    'material_desc' => ['required'],
                );

                $messages = [
                    'name_of_party.required_if' => __('Name of Party is required'),
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
                    $img = Image::make($material_cover->path());
                    $img->resize(700, 300, function ($constraint) {
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
            $data['folders'] = $f = Folder::where(['user_id' => Auth::user()->id])->get();
            $data['universities'] = University::Orderby('name', 'ASC')->get();
            return View('dashboard.admin.library.edit', $data);
        } catch (\Throwable $th) {
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
            dd($th->getMessage());
            //throw $th;
        }
    }

    public function view($id)
    {
        # code...
        try {
            //code...
            $data['material'] = $material = Material::with(['type', 'vendor', 'file', 'cover', 'country', 'subject'])->find($id);
            if (!$material) {
                Session::flash('warning', "No record found");
                return redirect()->route('admin.library');
            }
            $data['title'] = $material->title;
            $data['sn'] = 1;
            $data['histories'] = MaterialHistory::where('material_id', $material->id)->with(['trans', 'user'])->get();
            return View('dashboard.admin.library.view', $data);
        } catch (\Throwable $th) {
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
            dd($th->getMessage());
            //throw $th;
        }
    }
}