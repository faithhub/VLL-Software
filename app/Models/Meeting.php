<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    use HasFactory;

    protected $fillable = [
        'university_id',
        'user_id',
        'MTID',
        'title',
        'password',
        'start',
        'link',
        'end',
        'status',
        'details',
    ];

    protected $casts = [
        'details' => 'array',
    ];
}
