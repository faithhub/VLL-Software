<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Webex extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'client_secret',
        'redirect_uri',
        'refresh_token',
        'code',
        'baseUrl',
        'access_token',
        'access_token_expires',
        'refresh_token_expires',
        'refresh_token_active',
        'access_token_active',
    ];
}
