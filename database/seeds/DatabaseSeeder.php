<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker\Factory::create();

        foreach (range(1, 20) as $index) {
            $name = $faker->unique()->sentence(3);
            DB::table('categories')->insert([
                'name'             => $name,
                'slug'             => str_slug($name),
                'description'      => $faker->paragraph(),
                'meta_title'       => $faker->word,
                'meta_description' => $faker->paragraph(),
                'category_id'      => $index == 1 ? null : rand(1, $index)
            ]);
        }

        foreach (range(1, 20) as $index) {
            $name = $faker->unique()->sentence(3);
            DB::table('manufacturers')->insert([
                'name'              => $name,
                'slug'              => str_slug($name),
                'description'       => $faker->paragraph(),
                'description_short' => $faker->paragraph(),
                'meta_title'        => $faker->word,
                'meta_description'  => $faker->paragraph(),
            ]);
        }

        $manufacturersIds = \App\Manufacturer::all()->pluck('id')->toArray();
        $categoriesIds = \App\Category::all()->pluck('id')->toArray();

        foreach (range(1, 200) as $index) {
            $name = $faker->unique()->sentence(3);
            DB::table('products')->insert([
                'default_category_id' => $faker->randomElement($categoriesIds),
                'purchase_price'      => $faker->randomFloat(2, 10, 300),
                'price'               => $faker->randomFloat(2, 10, 300),
                'quantity'            => $faker->randomNumber(1),
                'name'                => $name,
                'slug'                => str_slug($name),
                'description'         => $faker->paragraph(),
                'description_short'   => $faker->paragraph(),
                'meta_title'          => $faker->word,
                'meta_description'    => $faker->paragraph(),
                'active'              => 1,
                'manufacturer_id'     => $faker->randomElement($manufacturersIds),
                'reference'           => $faker->word,

            ]);
        }

    }
}
