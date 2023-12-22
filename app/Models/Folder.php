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
        'name_of_author',
        'amount',
        'price',
        'duration',
        'publisher',
        'version',
        'tags',
        'country_id',
        'currency_id',
        'folder_cover_id',
    ];

    protected $casts = [
        'tags' => 'array'
    ];

    public function folder_cover()
    {
        return $this->hasOne(File::class, 'id', 'folder_cover_id')->withDefault();
    }

    public function mat_type()
    {
        return $this->hasOne(MaterialType::class, 'id', 'material_type_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}