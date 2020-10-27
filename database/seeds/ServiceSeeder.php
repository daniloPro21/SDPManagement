<?php

use App\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        for ($i=0; $i < 4; $i++) {
            Service::create([
                'name' => $faker->name,
                'description' => $faker->sentence,
                'is_delete' => false
            ]);
        }
    }
}