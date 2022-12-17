<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "slug",
        "code",
        "longcode",
        "gateway",
        "pay_with_bank",
        "active",
        "country",
        "currency",
        "type",
        "is_deleted"
    ];
}