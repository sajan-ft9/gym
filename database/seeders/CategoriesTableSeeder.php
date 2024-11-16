<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rootCategories = [
            ['name' => 'Technology', 'parent_id' => null],
            ['name' => 'Health', 'parent_id' => null],
            ['name' => 'Business', 'parent_id' => null],
            ['name' => 'Lifestyle', 'parent_id' => null],
        ];

        foreach ($rootCategories as $category) {
            $categoryId = Category::insertGetId($category);

            // Insert child categories for each root category
            if ($category['name'] === 'Technology') {
                Category::insert([
                    ['name' => 'Software', 'parent_id' => $categoryId],
                    ['name' => 'Hardware', 'parent_id' => $categoryId],
                    ['name' => 'AI & ML', 'parent_id' => $categoryId],
                ]);
            }

            if ($category['name'] === 'Health') {
                Category::insert([
                    ['name' => 'Nutrition', 'parent_id' => $categoryId],
                    ['name' => 'Fitness', 'parent_id' => $categoryId],
                    ['name' => 'Mental Health', 'parent_id' => $categoryId],
                ]);
            }

            if ($category['name'] === 'Business') {
                Category::insert([
                    ['name' => 'Entrepreneurship', 'parent_id' => $categoryId],
                    ['name' => 'Marketing', 'parent_id' => $categoryId],
                    ['name' => 'Finance', 'parent_id' => $categoryId],
                ]);
            }

            if ($category['name'] === 'Lifestyle') {
                Category::insert([
                    ['name' => 'Travel', 'parent_id' => $categoryId],
                    ['name' => 'Food & Drink', 'parent_id' => $categoryId],
                    ['name' => 'Home & Garden', 'parent_id' => $categoryId],
                ]);
            }
        }
    }
}
