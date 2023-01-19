<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubSpecialization extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function subspecializations()
    {
        return $this->belongsTo(Specialization::class, 'specialization_id', 'id');
    }

}
