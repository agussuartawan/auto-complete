<?php

use Faker\Generator as Faker;
use App\Customer;

$factory->define(Customer::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'addres' => $faker->address,
        'phone' => $faker->phoneNumber,
    ];
});
