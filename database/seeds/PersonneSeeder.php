<?php

use App\Personne;
use Illuminate\Database\Seeder;

class PersonneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        for ($i=0; $i < 100; $i++) {
            Personne::create([
                'nom' => $faker->name,
                'prenom' => $faker->name,
                'matricule' => $faker->randomNumber(),
                'grade' => 'ECI',
                'isDelete' => false
            ]);
        }
    }
}