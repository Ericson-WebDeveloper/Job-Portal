<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $with = ['detail'];
    protected $appends = ['specialize_ids', 'specialize_names'];

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    public function detail()
    {
        return $this->hasOne(JobDetail::class, 'job_id', 'id');
    }

    public function applications()
    {
        return $this->hasMany(JobApplication::class, 'job_id', 'id');
    }

    public function companyData()
    {
        return $this->company;
    }

    public function getSpecializeIdsAttribute()
    {
        $ids = [];
        $datas = json_decode($this->specialization);
        $ids = collect($datas)->map(function($specials) {
            return $specials->id;
        });

        return $ids;
    }

    public function getSpecializeNamesAttribute()
    {
        $names = [];
        $datas = json_decode($this->specialization);
        $names = collect($datas)->map(function($specials) {
            return $specials->name;
        });

        return $names;
    }
}
