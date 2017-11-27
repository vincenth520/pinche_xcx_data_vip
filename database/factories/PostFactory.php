<?php

use Faker\Generator as Faker;



$factory->define(App\Post::class, function (Faker $faker) {
    static $password;

    return [
        'title' => $faker->sentence,
        'body' => $faker->paragraph,
        'user_id' => factory(\App\User::class)->create()->id,
    ];
});
