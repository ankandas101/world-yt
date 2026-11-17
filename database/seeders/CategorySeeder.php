<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Main categories from the navigation
        $mainCategories = [
            'NEWS',
            'BUSINESS',
            'TECHNOLOGY',
            'ENTERTAINMENT',
            'HEALTH',
            'GAME',
            'DIGITAL MARKETING',
            'TRAVEL',
            'TIPS'
        ];

        // Create main categories
        $index = 1;
        foreach ($mainCategories as $categoryName) {
            Category::create([
                'name' => $categoryName,
                'slug' => strtolower(str_replace(' ', '-', $categoryName)),
                'parent_id' => null,
                'description' => $categoryName . ' category',
                'order' => $index
            ]);
            $index++;
        }

        // Get the GAME category
        $gameCategory = Category::where('name', 'GAME')->first();

        // Subcategories for GAME
        $gameSubcategories = [
            'BGMI',
            'Fifa Mobile',
            'Free Fire',
            'Roblox',
            'Stumble guys',
        ];

        // Create subcategories under GAME
        $i = 1;
        foreach ($gameSubcategories as $subcategoryName) {
            Category::create([
                'name' => $subcategoryName,
                'slug' => strtolower(str_replace(' ', '-', $subcategoryName)),
                'parent_id' => $gameCategory->id,
                'description' => $subcategoryName . ' gaming subcategory',
                'order' => $gameCategory->order * 100 + $i
            ]);
            $i++;
        }
    }
}