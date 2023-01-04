<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'type',
        'session',
        'session_duration',
        'system',
        'system_duration',
        'annual',
        'quarterly',
        'monthly',
        'weekly',
        'max_teammate',
        'desc'
    ];
}