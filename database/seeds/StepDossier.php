<?php

use App\Step;
use Illuminate\Database\Seeder;

class StepDossier extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        for ($i=0; $i <100 ; $i++) {
            Step::create([
                'dossier_id' => $faker->numberBetween(1, 50),
                'type' => $faker->randomElement(['info', 'warning', 'move']),
                'message' => $faker->sentence,
                'action_date' => now(),
                'is_delete' => false
            ]);
        }
    }
}