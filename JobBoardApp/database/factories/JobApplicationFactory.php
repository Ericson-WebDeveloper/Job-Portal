<?php

namespace Database\Factories;

use App\Models\Job;
use App\Models\JobApplication;
use Illuminate\Database\Eloquent\Factories\Factory;

class JobApplicationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = JobApplication::class;
    public function definition()
    {
        return [
            'user_id' => 43,
            'job_id' => Job::select('id')->inRandomOrder()->first(),
            'message' => $this->faker->sentence(),
            'cv' => 'public/csv/no7eaZqGEMHpuCxvIPudm7wI1NvwQSuPqwPnK6xn.pdf'
        ];
    }
}
