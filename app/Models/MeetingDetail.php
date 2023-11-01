<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeetingDetail extends Model
{
    use HasFactory;



    protected $fillable = [
        'meeting_id',
        'participants'
    ];

    protected $casts = [
        'participants' => 'array',
    ];
}
