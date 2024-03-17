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
        'dom_bank_id',
        'dom_acc_number',
        'dom_acc_name',
        'dom_acc_verified',
        'sub_id',
        'sub_admin',
        'default_currency_id',
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
        return $this->hasMany(LoginHistory::class);
    }

    public function bank()
    {
        return $this->hasOne(Bank::class, 'id', 'bank_id');
    }

    public function dom()
    {
        return $this->hasOne(Bank::class, 'id', 'dom_bank_id')->withDefault();
    }

    public function country()
    {
        return $this->hasOne(Country::class, 'id', 'country_id');
    }

    public function profile_pics()
    {
        return $this->hasOne(File::class, 'id', 'avatar')->withDefault();
    }

    public function school()
    {
        return $this->hasOne(University::class, 'id', 'university_id')->withDefault();
    }

    public function team()
    {
        return $this->hasOne(Team::class, 'id', 'team_id')->withDefault();
    }

    public function sub()
    {
        return $this->hasOne(SubHistory::class, 'id', 'sub_id')->withDefault();
    }

    public function currency()
    {
        return $this->hasOne(Currency::class, 'id', 'default_currency_id')->withDefault();
    }
}