<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\User;
use App\Models\Car;
use App\Models\CarModel;
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
        Brand::factory(10)->create();
        CarModel::factory(10)->create();
        Car::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
