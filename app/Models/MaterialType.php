<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialType extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "mat_unique_id",
        "description",
        "status",
        "role"
    ];

    protected $casts = [
        'role' => 'array'
    ];
}