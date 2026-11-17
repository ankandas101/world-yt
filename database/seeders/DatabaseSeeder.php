<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            // ShieldSeeder::class,
            UserSeeder::class,
        ]);

        // Create a single category
        $category = Category::factory()->create();

        // Create multiple categories
        $categories = Category::factory()->count(10)->create();
    }
}
