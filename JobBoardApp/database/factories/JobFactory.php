<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    // protected $model = Job::class;

    public function definition()
    {
        $ids = [10, 11, 12];
        return [
            'company_id' => $ids[rand(0,2)],
            'title' =>  $this->faker->name(),
            'position' =>  $this->faker->name(),
            'specialization' => $this->faker->name(),
        ];
    }
}
