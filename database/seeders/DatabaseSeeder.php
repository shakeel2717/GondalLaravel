<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Country;
use App\Models\Month;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Administrator',
            'email' => 'admin@test.com',
            'password' => bcrypt("asdfasdf"),
            'phone' => "+145465465",
            'role' => 1,
        ]);


        \App\Models\User::factory()->create([
            'name' => 'Shakeel Ahmad',
            'email' => 'shakeel2717@gmail.com',
            'password' => bcrypt("asdfasdf"),
            'phone' => "+923037702717",
            'role' => 2,
        ]);

    }
}
