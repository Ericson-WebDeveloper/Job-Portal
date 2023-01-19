<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $with = ['detail'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function detail()
    {
        return $this->hasOne(CompanyDetail::class, 'company_id', 'id');
    }

    public function jobs()
    {
        return $this->hasMany(Job::class, 'company_id', 'id');
    }
}
