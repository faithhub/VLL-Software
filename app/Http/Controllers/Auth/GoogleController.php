<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function loginWithGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callbackFromGoogle()
    {
        try {
            $user = Socialite::driver('google')->user();

            // dd($user, $user->getId(), $user->getName(), $user->getEmail());
            // Check Users Email If Already There
            $data['name'] = $user->getName();
            $data['email'] = $user->getemail();
            // $is_user = User::where('email', $user->getEmail())->first();

            // if (!$is_user) {
            //     $saveUser = User::updateOrCreate([
            //         'google_id' => $user->getId(),
            //     ], [
            //         'name' => $user->getName(),
            //         'email' => $user->getEmail(),
            //         'password' => Hash::make($user->getName() . '@' . $user->getId())
            //     ]);
            // } else {
            //     $saveUser = User::where('email',  $user->getEmail())->update([
            //         'google_id' => $user->getId(),
            //     ]);
            //     $saveUser = User::where('email', $user->getEmail())->first();
            // }


            // Auth::loginUsingId($saveUser->id);

            return view('auth.google', $data);
            // return redirect()->route('home');
        } catch (\Throwable $th) {
            Session::flash('error', "Invalid grant");
            return redirect()->route('register');
            dd($th->getMessage());
            throw $th;
        }
    }

    public function callbackFromGoogle2()
    {
        try {
            $data['name'] = "ukyguejvbhjasb hbjsab,jsa";
            $data['email'] = "ade@gmail.cmom";
            return view('auth.google', $data);
            // return redirect()->route('home');
        } catch (\Throwable $th) {
            Session::flash('error', "Invalid grant");
            return redirect()->route('register');
            dd($th->getMessage());
            throw $th;
        }
    }
}