<?php

use App\Reply;
use Illuminate\Database\Seeder;

class RepliesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        foreach (range(1,50) as $index) {
        	Reply::create([
        		'user_id' => $faker->numberBetween(1, 15),
        		'post_id' => $faker->numberBetween(1, 25),
        		'body' => $faker->senetence(5),
        		'created_at' => $faker->dateTime,
        		'udated_at' => $faker->dateTime
        		]);
        }
    }
}
