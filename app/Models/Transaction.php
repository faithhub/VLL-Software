<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        "user_id",
        "subscription_id",
        "invoice_id",
        "currency_id",
        "date",
        "amount",
        "status",
        "type",
        'reference',
        'trxref'
    ];


    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function mat_his()
    {
        return $this->hasOne(MaterialHistory::class);
    }
    public function currency()
    {
        return $this->hasOne(Currency::class, 'id', 'currency_id');
    }
}