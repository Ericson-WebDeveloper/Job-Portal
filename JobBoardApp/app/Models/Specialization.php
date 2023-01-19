<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialization extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function subspecializations()
    {
        return $this->hasMany(SubSpecialization::class, 'specialization_id', 'id');
    }
}
