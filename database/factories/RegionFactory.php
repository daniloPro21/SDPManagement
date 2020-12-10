<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Region;
use Faker\Generator as Faker;

$factory->define(Region::class, function (Faker $faker) {
    return [
        'nom'=> 'Extreme-Nord'
    ];
});
$factory->define(Region::class, function (Faker $faker) {
    return [
        'nom'=> 'Centre'
    ];
});
$factory->define(Region::class, function (Faker $faker) {
    return [
        'nom'=> 'Oeust'
    ];
});
$factory->define(Region::class, function (Faker $faker) {
    return [
        'nom'=> 'Nord'
    ];
});
$factory->define(Region::class, function (Faker $faker) {
    return [
        'nom'=> 'Adamaoua'
    ];
});
$factory->define(Region::class, function (Faker $faker) {
    return [
        'nom'=> 'Oeust'
    ];
});
$factory->define(Region::class, function (Faker $faker) {
    return [
        'nom'=> 'Sud-oeust'
    ];
});
$factory->define(Region::class, function (Faker $faker) {
    return [
        'nom'=> 'Est'
    ];
});
$factory->define(Region::class, function (Faker $faker) {
    return [
        'nom'=> 'Littoral'
    ];
});
$factory->define(Region::class, function (Faker $faker) {
    return [
        'nom'=> 'Sud'
    ];
});

