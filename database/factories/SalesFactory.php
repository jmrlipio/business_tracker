<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Sale::class, function (Faker $faker) {

    return [
        'business_id' => $faker->numberBetween(1, 2),
        'amount' => $faker->numberBetween($min = 100, $max = 2500)
    ];
});
