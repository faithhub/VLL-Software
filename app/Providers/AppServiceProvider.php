<?php

namespace App\Providers;

use App\Models\Currency;
use App\Models\Setting;
// use App\Validators;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Request as Requestt;
use Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $ip = Requestt::getClientIp();

        if ($ip == "127.0.0.1") {
            // $ip = '98.97.79.78';
            $ip = '198.166.231.223';
        }

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://ip-api.com/json/' . $ip,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $response = json_decode($response, true);

        if ($response) {
            if ($response['status'] == 'success') {
                date_default_timezone_set($response['timezone'] ?? config('app.timezone'));
            }
        }

        Validator::extend('recaptcha', 'App\Validators\ReCaptcha@validate');

        $settings = Cache::remember('settings', 3600, function () {
            return Setting::all([
                'key', 'value'
            ])
                ->keyBy('key')
                ->transform(function ($setting) {
                    return $setting->value;
                });
        });

        $currencies = [];
        $app_default_currency = null;
        if (Schema::hasTable('currencies')) {
            // Code to create table
            $currencies = Currency::all();
            $app_default_currency = Currency::where('isDefault', true)->first();
        }

        View::share(['settings' => $settings, 'app_currencies' => $currencies, 'app_default_currency' => $app_default_currency]);
    }
}