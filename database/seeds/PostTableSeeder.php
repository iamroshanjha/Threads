<?php

use App\Post;
use Illuminate\Database\Seeder;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        foreach (range(1,25) as $index) {
        	Post::create([
        		'user_id' => $faker->numberBetween(1, 15),
        		'category_id' => $faker->numberBetween(1, 5),
        		'title' => $faker->senetence(1),
        		'body' => $faker->senetence(3),
        		'slug' => $faker->slug,
        		'created_at' => $faker->dateTime,
        		'udated_at' => $faker->dateTime
        		]);
        }
    }
}
