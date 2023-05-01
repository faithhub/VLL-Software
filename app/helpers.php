<?php

use App\Models\Currency;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

function money($amount, $id = NULL)
{
    if (!Schema::hasTable('currencies')) {
        return 0;
    }
    if (!isset($amount)) {
        return "--";
    }

    $app_default_currency = Currency::where('isDefault', true)->first();
    $user_default = Currency::find(Auth::user()->default_currency_id);
    $value_curr = Currency::find($id);

    if ($value_curr) {
        if (isset($user_default)) {
            if ($value_curr->id == $user_default->id) {
                $result = $value_curr->symbol . number_format($amount, 2);
                return $result;
            }
        } else {
            if ($value_curr->id == $app_default_currency->id) {
                $result = $value_curr->symbol . number_format($amount, 2);
                return $result;
            } else {
                if ($app_default_currency->code == "NGN") {
                    $value = $amount * $value_curr->rate;
                } else {
                    $value_new = $amount * $value_curr->rate;
                    $value = $value_new / $user_default->rate;
                }

                $result = $app_default_currency->symbol . number_format($value, 2);
                return $result;
            }
        }


        if (isset($user_default)) {
            if ($user_default->code == "NGN") {
                $value = $amount * $value_curr->rate;
            } else {
                $value_new = $amount * $value_curr->rate;
                $value = $value_new / $user_default->rate;
            }

            $result = $user_default->symbol . number_format($value, 2);
            return $result;
        }
    }
    
    if (isset($user_default)) {
        $value = $amount / $user_default->rate;
        $result = $user_default->symbol . number_format($value, 2);
        return $result;
    }

    $value = $amount / $app_default_currency->rate ?? 1;
    $result = $app_default_currency->symbol . number_format($value, 2);
    return $result;
}

function exchange($amount, $id = NULL)
{
    if (!Schema::hasTable('currencies')) {
        return 0;
    }
    if (!isset($amount)) {
        return "--";
    }

    $app_default_currency = Currency::where('isDefault', true)->first();
    $user_default = Currency::find(Auth::user()->default_currency_id);
    $value_curr = Currency::find($id);

    if ($value_curr) {
        if (isset($user_default)) {
            if ($value_curr->id == $user_default->id) {
                $result = $amount;
                return $result;
            }
        } else {
            if ($value_curr->id == $app_default_currency->id) {
                $result = $amount;
                return $result;
            } else {
                if ($app_default_currency->code == "NGN") {
                    $value = $amount * $value_curr->rate;
                } else {
                    $value_new = $amount * $value_curr->rate;
                    $value = $value_new / $user_default->rate;
                }

                $result = $value;
                return $result;
            }
        }


        if (isset($user_default)) {
            if ($user_default->code == "NGN") {
                $value = $amount * $value_curr->rate;
            } else {
                $value_new = $amount * $value_curr->rate;
                $value = $value_new / $user_default->rate;
            }

            $result = $value;
            return $result;
        }
    }

    if (isset($user_default)) {
        $value = $amount / $user_default->rate;
        $result = $value;
        return $result;
    }

    $value = $amount / $app_default_currency->rate ?? 1;
    $result = $value;
    return $result;
}

function paystack_money($amount)
{
    if (!Schema::hasTable('currencies')) {
        return 0;
    }
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