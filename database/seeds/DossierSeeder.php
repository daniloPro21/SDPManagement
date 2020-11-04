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
        $matricule = str_random(6);

        for ($i = 0; $i<=100; $i++) {
            Dossier::create([
            'service_id' => null,
            'personne_id' => $faker->numberBetween(1, 30),
            'type_id' => $faker->numberBetween(1, 10),
            'date_entre' => now(),
            'date_sortie' => $faker->date('Y-m-d', $max = '01-01/2030'),
            'note' => $faker->sentence,
            'num_dra' => $faker->numberBetween(1, 40000),
            'num_sdp' => $faker->numberBetween(1, 40000),
            'num_service' => $faker->numberBetween(1, 4),
            'traiter' => $faker->boolean(),
            'is_delete' => false,
          ]);
        }
    }
}
