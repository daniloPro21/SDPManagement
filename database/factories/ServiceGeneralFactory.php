<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\ServiceGeneral;
use Faker\Generator as Faker;

$factory->define(ServiceGeneral::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->sentence,
        'english' => $faker->sentence,
        'is_delete' => false
    ];
});
