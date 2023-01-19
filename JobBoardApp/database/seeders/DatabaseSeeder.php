<?php

namespace Database\Seeders;

use App\Models\Job;
use Database\Factories\JobFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        // $this->call(RoleSeeder::class);
        // $this->call(AdminSeeder::class);
        // $this->call(JobFactory::class);
        //\App\Models\Job::factory(50)->create();
        //\App\Models\JobDetail::factory(50)->create();
        \App\Models\JobApplication::factory(30)->create();
    }
}
