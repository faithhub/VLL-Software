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
        "folder_id",
        "transaction_id",
        "invoice_id",
        "date",
        "folder_expired_date",
        "date_rented_expired",
        "isFolderExpired",
        "rent_count",
        "unique_id",
        "mat_type",
        "class_id",
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

    public function class()
    {
        return $this->hasOne(Material::class, 'id', 'class_id');
    }
    public function folder()
    {
        return $this->hasOne(Folder::class, 'id', 'folder_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}