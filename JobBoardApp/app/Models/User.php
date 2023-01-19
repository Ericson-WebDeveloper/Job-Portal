<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'remember_token'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $with = ['detail', 'roles', 'applications'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function detail()
    {
        return $this->hasOne(UserDetail::class, 'user_id','id');
    }
    public function tokenpass()
    {
        return $this->belongsTo(UserTokenResetPass::class, 'user_id', 'id');
    }

    public function company()
    {
        return $this->hasOne(Company::class, 'user_id', 'id');
    }

    public function applications()
    {
        return $this->hasMany(JobApplication::class, 'user_id', 'id');
    }

}
