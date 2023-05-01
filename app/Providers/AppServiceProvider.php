<?php

namespace App\Providers;

use App\Models\Currency;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        $currencies = Currency::all();
        $app_default_currency = Currency::where('isDefault', true)->first();
        
        View::share(['settings' => $settings, 'app_currencies' => $currencies, 'app_default_currency' =>
        $app_default_currency]);
    }
}