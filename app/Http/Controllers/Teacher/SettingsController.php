<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\File;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SettingsController extends Controller
{

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
                return redirect()->route('teacher.settings');
            }
            $data['title'] = "Profile";
            return View('dashboard.teacher.settings.index', $data);
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return redirect()->route('teacher')->with('error', $th->getMessage());
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
            return View('dashboard.teacher.settings.change-password', $data);
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return redirect()->route('teacher')->with('error', $th->getMessage());
            //throw $th;
        }
    }
}
