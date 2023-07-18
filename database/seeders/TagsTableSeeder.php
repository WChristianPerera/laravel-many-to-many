<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = [
            [
                'name'  => 'php',
            ],
            [
                'name'  => 'js',
            ],
            [
                'name'  => 'maturità',
            ],
            [
                'name'  => 'estero',
            ],
            [
                'name'  => 'Italia',
            ],
            [
                'name'  => 'Europa',
            ],
            [
                'name'  => 'laravel',
            ],
            [
                'name'  => 'primi piatti',
            ],
            [
                'name'  => 'pesce',
            ],
            [
                'name'  => 'trasporti',
            ],
            [
                'name'  => 'auto',
            ],
            [
                'name'  => 'moto',
            ],
            [
                'name'  => 'bici',
            ],
            [
                'name'  => 'viaggi',
            ],
        ];

        foreach ($tags as $tag) {
            Tag::create($tag);
        }
    }
}
