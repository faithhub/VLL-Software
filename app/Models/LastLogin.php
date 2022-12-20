<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LastLogin extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "ip",
        "browserFamily",
        "browserVersion",
        "platformVersion",
        "platformFamily",
        "countryName",
        "regionName",
        "cityName",
        "latitude",
        "longitude",
        "timezone",
    ];
}