<?php

use App\Models\Currency;
use Illuminate\Support\Facades\Auth;

function money($amount)
{
    if (!isset($amount)) {
        return "--";
    }

    $app_default_currency = Currency::where('isDefault', true)->first();
    $user_default = Currency::find(Auth::user()->default_currency_id);

    if (isset($user_default)) {
        $value = $amount / $user_default->rate;
        $result = $user_default->symbol . number_format($value, 2);
        return $result;
    }

    $value = $amount / $app_default_currency->rate ?? 1;
    $result = $app_default_currency->symbol . number_format($value, 2);
    return $result;
}

function paystack_money($amount)
{
    $app_default_currency = Currency::where('isDefault', true)->first();
    $user_default = Currency::find(Auth::user()->default_currency_id);

    if (isset($user_default)) {
        $value = $amount / $user_default->rate;
        $result = $value * 100;
        return $result;
    }

    if (!isset($app_default_currency)) {
        return false;
    }
    $value = $amount / $app_default_currency->rate ?? 1;
    $result = $value * 100;
    return $result;
}