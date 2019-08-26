<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Expense::class, function (Faker $faker) {
    return [
        'business_id' => $faker->numberBetween(1, 2),
        'quantity' => $faker->numberBetween(1, 2),
        'amount' => $faker->numberBetween($min = 10, $max = 200),
        'description' => $faker->text(250)
    ];
});
