<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MasterClass extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'uploaded_by',
        'title',
        'duration',
        'interval',
        'dates',
        'time',
        'price',
        'amount',
        'currency_id',
        'instructor_name',
        'special_guest',
        'desc',
        'master_class_id',
        'status',
        'timezone',
        'meeting_ids',
    ];

    protected $casts = [
        'dates' => 'array',
        'meeting_ids' => 'array'
    ];

    public function cover()
    {
        return $this->hasOne(File::class, 'id', 'master_class_id');
    }

    public function vendor()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function class_his()
    {
        return $this->hasOne(MaterialHistory::class, 'class_id', 'id');
    }

    public function meeting()
    {
        return $this->belongsToMany(Meeting::class);
    }

    // public function getMeetingIdsAttribute()
    // {
    //     return $this->meeting->pluck('meeting_ids');
    // }
}