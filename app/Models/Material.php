<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Material extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        "user_id",
        "title",
        "name_of_author",
        "version",
        "price",
        "amount",
        "material_type_id",
        "folder_id",
        "year_of_publication",
        "country_id",
        "publisher",
        "tags",
        "subject_id",
        "privacy_code",
        "material_file_id",
        "material_cover_id",
        "material_desc",
        "test_country_id",
        "name_of_party",
        "name_of_court",
        "citation",
        "uploaded_by",
        "university_id"
    ];
    protected $casts = [
        'tags' => 'array'
    ];


    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function vendor()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function type()
    {
        return $this->hasOne(MaterialType::class, 'id', 'material_type_id');
    }

    public function subject()
    {
        return $this->hasOne(Subject::class, 'id', 'subject_id');
    }

    public function mat_his()
    {
        return $this->hasOne(MaterialHistory::class, 'material_id', 'id');
    }

    public function file()
    {
        return $this->hasOne(File::class, 'id', 'material_file_id');
    }

    public function cover()
    {
        return $this->hasOne(File::class, 'id', 'material_cover_id');
    }

    public function country()
    {
        return $this->hasOne(Country::class, 'id', 'country_id');
    }

    public function test_country()
    {
        return $this->hasOne(Country::class, 'id', 'test_country_id');
    }

    public function university()
    {
        return $this->hasOne(University::class, 'id', 'university_id');
    }

    public function folder()
    {
        return $this->hasOne(Folder::class, 'id', 'folder_id');
    }
}