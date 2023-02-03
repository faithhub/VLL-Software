<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;
    protected $fillable = [
        'teammates',
        'materials',
        'sub_status',
        'subscription_id',
        'start_date',
        'end_date'
    ];

    protected $casts = [
        'teammates' => 'array',
        'materials' => 'array',
    ];
}