<?php

use Illuminate\Database\Seeder;
use App\Post;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for($i=0; $i<10; $i++){
            $post = new Post();
            $post->title = $faker->words(3,true);
            $post->content = $faker->text();
            $post->published = rand(0,1);
            $post->slug = Str::of($post->title)->slug('-');
            $post->save();
        }
    }
}
