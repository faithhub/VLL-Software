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
        'meeting_id',
    ];

    protected $casts = [
        'dates' => 'array'
    ];

    public function cover()
    {
        return $this->hasOne(File::class, 'id', 'master_class_id');
    }

    public function meeting()
    {
        return $this->hasOne(Meeting::class, 'id', 'meeting_id');
    }
}
