<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Note extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        "material_id",
        "user_id",
        "title",
        "content"
    ];

    public function mat()
    {
        return $this->hasOne(Material::class, 'id', 'material_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}