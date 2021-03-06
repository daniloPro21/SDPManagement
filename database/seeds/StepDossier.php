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
                'dossier_id' => $faker->numberBetween(1, 100),
                'type' => $faker->randomElement(['info', 'warning', 'move']),
                'user_id' => 1,
                'message' => $faker->sentence,
                'action_date' => now(),
                'is_delete' => false
            ]);
        }
    }
}
