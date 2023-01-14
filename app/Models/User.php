<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'user_type',
        'vendor_type',
        'gender',
        'phone',
        'avatar',
        'status',
        'team_admin',
        'last_login_at',
        'last_login_ip',
        'country_id',
        'university_id',
        'subscription_id',
        'team_id',
        'bank_id',
        'acc_name',
        'acc_number',
        'acc_verified'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // public function last_login()
    // {
    //     return $this->hasOne(LastLogin::class, 'id', 'user_id');
    // }
    public function last_login()
    {
        return $this->hasOne(LoginHistory::class, 'user_id');
    }

    public function profile_pics()
    {
        return $this->hasOne(File::class, 'id', 'avatar')->withDefault();
    }
}