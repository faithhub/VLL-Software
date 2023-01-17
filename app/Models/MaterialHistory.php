<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MaterialHistory extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        "material_id",
        "user_id",
        "transaction_id",
        "invoice_id",
        "date",
        "type"
    ];
}