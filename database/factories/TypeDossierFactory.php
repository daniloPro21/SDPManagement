<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\TypeDossier;
use Faker\Generator as Faker;

$factory->define(TypeDossier::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->sentence
    ];
});
