<?php

namespace Database\Seeders;

use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $categories = Category::all();
        $categories->shift();

        $tags = Tag::all()->pluck('id');
        // $coll = [
        //     [
        //         'id'    => 1,
        //         'nome'  => 'ciao',
        //     ],
        //     [
        //         'id'    => 2,
        //         'nome'  => 'ciao',
        //     ],
        //     [
        //         'id'    => 3,
        //         'nome'  => 'ciao',
        //     ],
        // ];

        // $coll->pluck('id');

        // risultato: [
        //     1,
        //     2,
        //     3,
        // ]

        for ($i = 0; $i < 50; $i++) {
            $title = $faker->words(rand(2, 10), true);  
            $slug = Post::slugger($title);              
            $imageIndex = rand(0, 276);

            $post = Post::create([
                'category_id'   => $faker->randomElement($categories)->id,
                'title'         => Str::ucfirst($title),
                'slug'          => $slug,
                'url_image'     => 'https://picsum.photos/id/' . rand(1, 270) . '/500/400',
                'image'         => $imageIndex ? 'uploads/picsum' . $imageIndex . '.jpg' : null,
                'content'       => $faker->paragraphs(rand(2, 20), true),
            ]);


            $post->tags()->sync($faker->randomElements($tags, null));
        }
    }
}