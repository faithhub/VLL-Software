<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubHistory extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        "date_subscribed",
        "subscription_id",
        "start_date",
        "expired_date",
        "isActive",
        "user_id"
    ];

    public function sub()
    {
        return $this->hasOne(Subscription::class, 'id', 'subscription_id');
    }
}