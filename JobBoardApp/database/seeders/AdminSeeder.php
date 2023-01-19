<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Admin',
            'email' => 'email@gmail.com',
            'password' => Hash::make('123456'),
        ]);

        $user->detail()->create([
            'age' => rand(20, 35),
            'address' => 'Philippines'
        ]);

        $user->assignRole(2);
    }
}
