<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Dossier;
use Faker\Generator as Faker;

$factory->define(Dossier::class, function (Faker $faker) {
    return [
        'date_entre' => $faker->dateTime,
        'telephone' => $faker->phoneNumber,
        'date_sortie' => $faker->dateTime,
        'note' => $faker->sentence,
        'num_drh' => $faker->numberBetween(1000, 10000000),
        'num_courrier' => $faker->numberBetween(1000, 10000000),
        'statut' => null,
        'type_id' => $faker->numberBetween(1,10),
        'nom' => $faker->name,
        'service_id' => null,
        'prenom' => $faker->state,
        'matricule' => $faker->numberBetween(1, 999999),
        'grade' => $faker->randomElement(['ECI','CH1', 'CA1', 'B2']),
    ];
});
