<?php

use Faker\Generator as Faker;

$factory->define(App\Thread::class, function (Faker $faker) {
    return [
        "title" => $faker->sentence,
        "description" => $faker->paragraph
    ];
});
