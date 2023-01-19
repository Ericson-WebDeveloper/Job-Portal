<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class CompanyDetail extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    public function getAdditionalInfoAttribute($value)
    {
        return $value ? json_decode($value) : [];
    }

    public function getImageAttribute($value)
    {
        return $value != null ? asset(Storage::url($value)) : null;
    }
}
