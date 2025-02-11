<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoginHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "ip",
        "browserFamily",
        "browserVersion",
        "platformVersion",
        "platformFamily",
        "deviceType",
        "countryName",
        "regionName",
        "cityName",
        "latitude",
        "longitude",
        "timezone",
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}