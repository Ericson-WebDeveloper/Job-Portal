<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobDetail extends Model
{
    use HasFactory;

    protected $fillable = ['job_id', 'salary', 'job_details', 'additional_details'];

    public function company()
    {
        return $this->belongsTo(Job::class, 'job_id', 'id');
    }

    public function getAdditionalDetailsAttribute($value)
    {
        return $value ? json_decode($value) : [];
    }
}
