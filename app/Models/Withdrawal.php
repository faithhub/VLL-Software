<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'wallet_id',
        'amount',
        'amount_paid',
        'status',
        'tran_id',
        'fee',
        'account_paid_to',
        'amount_withdraw'
    ];

    protected $casts = [
        'account_paid_to' => 'array'
    ];

    public function wallet()
    {
        return $this->hasOne(Wallet::class, 'id', 'wallet_id');
    }
    public function vendor()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}