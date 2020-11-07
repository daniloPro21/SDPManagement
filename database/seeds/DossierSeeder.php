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
            'type_id' => $faker->numberBetween(1, 7),
            'date_entre' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now'),
            'date_sortie' => $faker->date('Y-m-d', $max = '2020-01-01'),
            'note' => $faker->sentence,
            'num_dra' => $faker->numberBetween(40000, 1000000),
            'num_sdp' => $faker->numberBetween(40000, 1000000),
            'num_service' => $faker->numberBetween(1, 4),
            'traiter' => true,
            'telephone' => $faker->phoneNumber,
            'nom' => $faker->name,
            'prenom' => $faker->lastName,
            'matricule' => $faker->randomNumber(),
            'grade' => 'ECI',
            'is_delete' => false,
          ]);
        }
    }
}
