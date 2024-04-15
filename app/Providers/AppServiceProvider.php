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

        // if (Schema::hasTable('currencies')) {
        // $ipp = Requestt::getClientIp();
        // $ip = Http::get('https://ipecho.net/' . $ipp . '/json');
        // if ($ip->json('timezone')) {
        //     dd($ip->json('timezone'));
        //     return $ip->json('timezone');
        // }
        $currencies = Currency::all();
        $app_default_currency = Currency::where('isDefault', true)->first();
        // dd($settings, $ipp, $ip->json('timezone'), timezone_identifiers_list(), timezone_version_get());
        // Config::set('app.timezone', $db['timezone'] ?? config('app.timezone'));
        // date_default_timezone_set($settings->timezone ? $settings->timezone : config('app.timezone'));
        View::share(['settings' => $settings, 'app_currencies' => $currencies, 'app_default_currency' =>
        $app_default_currency]);
    }
}