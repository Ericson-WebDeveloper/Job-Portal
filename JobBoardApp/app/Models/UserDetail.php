<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class UserDetail extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'age',
        'address',
        'course',
        'college',
        'experience',
        'current_job',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function getImageAttribute($value)
    {
        return $value != null ? asset(Storage::url($value)) : null;
    }

    public function getExperienceAttribute($value)
    {
        return $value ? json_decode($value) : [];
    }
}
