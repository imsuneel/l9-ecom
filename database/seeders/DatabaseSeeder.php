<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Attribute;
use App\Models\Category;
use App\Models\Option;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductOption;
use App\Models\ProductToCategory;
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
        Attribute::factory(10)->create();
        Option::factory(10)->create();
        Category::factory(10)->create();
        Product::factory(100)->create();
        ProductToCategory::factory(100)->create();
        ProductAttribute::factory(10)->create();
        ProductOption::factory(10)->create();
    }
}
