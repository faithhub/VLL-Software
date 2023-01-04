<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        // dd($data);
        if ($data['form_type'] == "vendor") {
            Session::flash('warning', __('All fields are required'));
            return Validator::make(
                $data,
                [
                    'type' => ['required', 'string', 'max:255'],
                    'terms' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                    'password' => ['required', 'string', 'min:8', 'confirmed'],
                    'v-country' => ['required_if:type,==,institution'],
                    'name' => ['required_if:type,==,company,entity'],
                    'v-university' => ['required_if:type,==,institution'],
                ],
                [
                    'required_if' => 'The :attribute field is required.',
                    'v-country.required_if' => __('The country field is required'),
                    'v-university.required_if' => __('The university field is required')
                ]
            );
        }

        if ($data['form_type'] == "user") {
            Session::flash('warning', __('All fields are required'));
            return Validator::make(
                $data,
                [
                    'name' => ['required', 'string', 'max:255'],
                    'type' => ['required', 'string', 'max:255'],
                    'terms' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                    'password' => ['required', 'string', 'min:8', 'confirmed'],
                    'university' => ['required_if:type,==,student'],
                    'country' => ['required_if:type,==,student'],
                ],
                [
                    'required_if' => 'The :attribute field is required.'
                ]
            );
        }
        return back();
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        // dd($data);
        // return back();
        if ($data['form_type'] == "user") {
            # code...
            return User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'role' => $data['form_type'],
                'user_type' => $data['type'],
                'university_id' => $data['university'] ?? null,
                'country_id' => $data['country'] ?? null,
                'password' => Hash::make($data['password']),
            ]);
        }

        if ($data['form_type'] == "vendor") {
            return User::create([
                'name' => $data['name'] ?? null,
                'email' => $data['email'],
                'role' => $data['form_type'],
                'vendor_type' => $data['type'],
                'university_id' => $data['v-university'] ?? null,
                'country_id' => $data['v-country'] ?? null,
                'password' => Hash::make($data['password']),
            ]);
        }
    }
}