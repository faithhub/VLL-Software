<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Messages extends Model
{
    use HasFactory;
    protected $fillable = [
        "user_id",
        "admin_id",
        "msg",
        "file_name",
        "isChecked",
        "isMedia",
        "type",
        "media_id"
    ];

    public function file()
    {
        return $this->hasOne(File::class, 'id', 'media_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function admin()
    {
        return $this->hasOne(User::class, 'id', 'admin_id');
    }
}