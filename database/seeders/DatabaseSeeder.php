<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'jackson@gamil.com',
            'is_admin' => 0,
            'role' => 'student',
            'subscription_status' => 1,
            'phone_number' => "0390377422",

        ]);
    }
}
