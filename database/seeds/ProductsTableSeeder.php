<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1, 100) as $index) {
            DB::table('products')->insert([
                'id' => $faker->uuid,
                'title' => addslashes($faker->sentence(5)),
                'abstract' => addslashes($faker->realText(rand(80, 600))),
                'description' => addslashes($faker->realText(rand(10, 200))),
                'price' => $faker->randomFloat(2, 0, 1000),
                'image_url' => $faker->imageUrl(),
                'stock' => $faker->randomFloat(2, 0, 1000),
                'created_at' => $faker->dateTime(),
                'updated_at' => $faker->dateTime()
            ]);
        }
    }
}
