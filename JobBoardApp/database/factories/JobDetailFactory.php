<?php

namespace Database\Factories;

use App\Models\Job;
use App\Models\JobDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

class JobDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = JobDetail::class;

    public function definition()
    {
        return [
            'job_id' => Job::select('id')->inRandomOrder()
            ->limit(1)->first(),
            'salary' => '15k -  25k',
        ];
    }
}
