<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $categories = DB::table('categories')->pluck('id')->toArray();

        if (empty($categories)) {
            $this->command->info("No categories found. Seeder cannot proceed.");
            return;
        }

        $courses = [
            [
                'title' => 'Introduction to Programming',
                'description' => $faker->paragraph(),
                'price' => 99.99,
                'duration' => 120, // 2 hours
                'level' => 1, // Beginner
                'category_id' => $categories[array_rand($categories)], // Random category ID
            ],
            [
                'title' => 'Advanced PHP Development',
                'description' => $faker->paragraph(),
                'price' => 199.99,
                'duration' => 180, // 3 hours
                'level' => 3, // Advanced
                'category_id' => $categories[array_rand($categories)], // Random category ID
            ],
            [
                'title' => 'Mastering JavaScript',
                'description' => $faker->paragraph(),
                'price' => 149.99,
                'duration' => 150, // 2.5 hours
                'level' => 2, // Intermediate
                'category_id' => $categories[array_rand($categories)], // Random category ID
            ],
            [
                'title' => 'Web Design Fundamentals',
                'description' => $faker->paragraph(),
                'price' => 89.99,
                'duration' => 90, // 1.5 hours
                'level' => 1, // Beginner
                'category_id' => $categories[array_rand($categories)], // Random category ID
            ],
            [
                'title' => 'Data Science with Python',
                'description' => $faker->paragraph(),
                'price' => 299.99,
                'duration' => 240, // 4 hours
                'level' => 3, // Advanced
                'category_id' => $categories[array_rand($categories)], // Random category ID
            ],
            [
                'title' => 'Learn SQL for Data Analysis',
                'description' => $faker->paragraph(),
                'price' => 129.99,
                'duration' => 150, // 2.5 hours
                'level' => 2, // Intermediate
                'category_id' => $categories[array_rand($categories)], // Random category ID
            ],
            [
                'title' => 'Building REST APIs with Laravel',
                'description' => $faker->paragraph(),
                'price' => 199.99,
                'duration' => 180, // 3 hours
                'level' => 2, // Intermediate
                'category_id' => $categories[array_rand($categories)], // Random category ID
            ],
            [
                'title' => 'Mobile App Development with Flutter',
                'description' => $faker->paragraph(),
                'price' => 249.99,
                'duration' => 210, // 3.5 hours
                'level' => 2, // Intermediate
                'category_id' => $categories[array_rand($categories)], // Random category ID
            ],
            [
                'title' => 'UX/UI Design for Beginners',
                'description' => $faker->paragraph(),
                'price' => 89.99,
                'duration' => 120, // 2 hours
                'level' => 1, // Beginner
                'category_id' => $categories[array_rand($categories)], // Random category ID
            ],
            [
                'title' => 'Cloud Computing with AWS',
                'description' => $faker->paragraph(),
                'price' => 349.99,
                'duration' => 240, // 4 hours
                'level' => 3, // Advanced
                'category_id' => $categories[array_rand($categories)], // Random category ID
            ],
        ];

        foreach ($courses as $course) {
            DB::table('courses')->insert($course);
        }


    }
}
