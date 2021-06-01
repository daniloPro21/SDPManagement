<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Service;
use Faker\Generator as Faker;

$factory->define(Service::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->sentence,
        'servicegeneral_id' => $faker->numberBetween(1, 20)
    ];
});
