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
        "rent_count",
        "rent_unique_id",
        "type"
    ];

    public function trans()
    {
        return $this->hasOne(Transaction::class, 'id', 'transaction_id');
    }

    public function mat()
    {
        return $this->hasOne(Material::class, 'id', 'material_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}