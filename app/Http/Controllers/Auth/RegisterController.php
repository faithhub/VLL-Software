<?php

namespace App\Http\Controllers\Auth;

use App\Models\LoginHistory;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Mail\UserWelcomeEmail;
use App\Mail\VendorWelcomeEmail;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Stevebauman\Location\Facades\Location;
use hisorange\BrowserDetect\Parser as Browser;
use Illuminate\Support\Facades\Auth;

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

        if ($data['form_type'] == "user"
        ) {
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

        if (
            $data['form_type'] == "teacher"
        ) {
            // dd($data);
            return Validator::make(
                $data,
                [
                    'type' => ['required', 'string', 'max:255'],
                    'terms' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                    'password' => ['required', 'string', 'min:8', 'confirmed'],
                    't-country' => ['required_if:type,==,institution'],
                    'name' => ['required_if:type,==,company,entity'],
                    't-university' => ['required_if:type,==,institution'],
                ],
                [
                    'required_if' => 'The :attribute field is required.',
                    't-country.required_if' => __('The country field is required'),
                    't-university.required_if' => __('The university field is required')
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
       
        try {
            //code...
            if ($data['form_type'] == "user") {
                # code...
                Mail::to($data['email'])->send(new UserWelcomeEmail($data['name']));
                $user = User::create([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'role' => $data['form_type'],
                    'user_type' => $data['type'],
                    'university_id' => $data['university'] ?? null,
                    'country_id' => $data['country'] ?? null,
                    'password' => Hash::make($data['password']),
                ]);

                $this->getLoginLogs($user->id);

                return $user;
            }

            if ($data['form_type'] == "vendor"
            ) {
                Mail::to($data['email'])->send(new VendorWelcomeEmail($data['name']));
                return User::create([
                    'name' => $data['name'] ?? null,
                    'email' => $data['email'],
                    'role' => $data['form_type'],
                    'user_type' => $data['type'],
                    'vendor_type' => $data['type'],
                    'university_id' => $data['v-university'] ?? null,
                    'country_id' => $data['v-country'] ?? null,
                    'password' => Hash::make($data['password']),
                ]);
            }

            if (
                $data['form_type'] == "teacher"
            ) {
                return redirect('login');
                // Mail::to($data['email'])->send(new VendorWelcomeEmail($data['name']));
                return User::create([
                    'name' => $data['name'] ?? null,
                    'email' => $data['email'],
                    'role' => $data['form_type'],
                    'user_type' => $data['type'],
                    'vendor_type' => $data['type'],
                    'university_id' => $data['t-university'] ?? null,
                    'country_id' => $data['t-country'] ?? null,
                    'password' => Hash::make($data['password']),
                ]);
            }
            // dd($data);
        } catch (\Throwable $th) {
            dd($th);
            //throw $th;
        }
    }

    public function getLoginLogs($user_id)
    {
        $ip = Request::getClientIp();
        $loc = Location::get($ip);
        $data['details'] = $details = [
            "user_id" => $user_id,
            "ip" => $loc->ip ?? "",
            "browserFamily" => Browser::browserFamily() ?? "",
            "browserVersion" => Browser::browserVersion() ?? "",
            "platformVersion" => Browser::platformVersion() ?? "",
            "platformFamily" => Browser::platformFamily() ?? "",
            "deviceType" => Browser::deviceType() ?? "",
            "countryName" => $loc->countryName ?? "",
            "regionName" => $loc->regionName ?? "",
            "cityName" => $loc->cityName ?? "",
            "latitude" => $loc->latitude ?? "",
            "longitude" => $loc->longitude ?? "",
            "timezone" => $loc->timezone ?? "",
            "last_login_at" =>  Carbon::now()->toDateTimeString()
        ];

        LoginHistory::create($details);
    }
}