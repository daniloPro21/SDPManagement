<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\Dossier;

class DossierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        for ($i = 0; $i<=100; $i++) {
            Dossier::create([
            'services_id' => $faker->numberBetween(1, 3),
            'personne_id' => $faker->numberBetween(1, 100),
            'type_id' => $faker->numberBetween('1,10'),
            'date_entre' => now(),
            'date_sortie' => $faker->date('Y-m-d', $max = '01-01/2030'),
            'note' => $faker->sentence,
            'num_dra' => $faker->numberBetween(100, 1323),
            'num_sdp' => $faker->numberBetween(10, 2323),
            'num_service' => $faker->numberBetween(1, 3),
            'traiter' => $faker->boolean(),
            'is_delete' => false,
          ]);
        }
    }
}
