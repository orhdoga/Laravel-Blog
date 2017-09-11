<?php

use Faker\Generator as Faker;

$factory->define(App\Thread::class, function (Faker $faker) {
    return [
    	'user_id' => function () {
            return factory(App\User::class)->create()->id;
        },
        "thumbnail" => "thumbnail-" . rand(1, 12) . ".jpg",
        "title" => $faker->sentence,
        "description" => $faker->paragraph,
        "body" => $faker->paragraph
    ];
});
