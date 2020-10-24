<?php

use App\TypeDossier;
use Illuminate\Database\Seeder;

class TypeDossierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        for ($i=0; $i < 15; $i++) {
            TypeDossier::create([
                'name' => $faker->name,
                'description' => $faker->sentence,
                'is_delete' => false
            ]);
        }
    }
}