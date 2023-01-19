<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class JobApplication extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function getCvAttribute($value)
    {
        return $value != null ? asset(Storage::url($value)) : null;
    }

    public function job()
    {
        return $this->belongsTo(Job::class, 'job_id', 'id');
    }
}
