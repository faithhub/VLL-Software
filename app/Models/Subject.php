<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "description",
        "material_type_id",
        "status"
    ];

    public function material()
    {
        return $this->belongsTo(MaterialType::class, 'material_type_id');
    }
}