<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        // Create categories
        Category::create(['name' => 'Laptops']);
        Category::create(['name' => 'Smartphones']);
        Category::create(['name' => 'Tablets']);
        Category::create(['name' => 'Headphones']);
        Category::create(['name' => 'Accessories']);
    }
}
