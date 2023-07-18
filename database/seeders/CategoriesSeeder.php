<?php

namespace Database\Seeders;

use Faker\Generator as Faker;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $categories = [
            [
                'name'          => 'Uncategorized',
                'description'   => $faker->words(rand(20, 50), true),
            ],
            [
                'name'          => 'Attualità',
                'description'   => $faker->words(rand(30, 60), true),
            ],
            [
                'name'          => 'Cucina',
                'description'   => $faker->words(rand(30, 100), true),
            ],
            [
                'name'          => 'Informatica',
                'description'   => $faker->words(rand(30, 100), true),
            ],
            [
                'name'          => 'Scuola',
                'description'   => $faker->words(rand(30, 100), true),
            ],
            [
                'name'          => 'Cronaca',
                'description'   => $faker->words(rand(30, 100), true),
            ],
            [
                'name'          => 'Politica',
                'description'   => $faker->words(rand(30, 100), true),
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}