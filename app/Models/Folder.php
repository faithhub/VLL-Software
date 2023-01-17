<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'material_type_id',
        'user_id',
        'folder_cover_id'
    ];

    public function folder_cover()
    {
        return $this->hasOne(File::class, 'id', 'folder_cover_id')->withDefault();
    }
}