<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\InternetPlan;

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
            'email' => 'test@example.com',
        ]);


        InternetPlan::create([
            'name' => 'Masaa 2 - Unlimited',
            'price' => 500, // in TZS
            'duration_minutes' => 120,
            'speed_limit' => 10240, // kbps
        ]);

        InternetPlan::create([
            'name' => 'Siku 1 - Unlimited',
            'price' => 1000,
            'duration_minutes' => 1440,
            'speed_limit' => 10240,
        ]);

        InternetPlan::create([
            'name' => 'Wiki 1 - Unlimited',
            'price' => 5000,
            'duration_minutes' => 10080,
            'speed_limit' => 10240,
        ]);

        InternetPlan::create([
            'name' => 'Mwezi 1 - Unlimited',
            'price' => 25000,
            'duration_minutes' => 43200,
            'speed_limit' => 10240,
        ]);
    }
}
