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

        for($i = 0; $i<=10; $i++){
          Dossier::create([
            'services_id' => $faker->Numberbetwwen()
          ]);
        }
    }
}
