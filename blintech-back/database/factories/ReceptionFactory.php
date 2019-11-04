<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Reception;
use Faker\Generator as Faker;

$factory->define(Reception::class, function (Faker $faker) {
    return [
        'idCustomer' => 1,
        'state' => 'Abierto',
        'description' => $faker->text(),
        'date' => now()
    ];
});
