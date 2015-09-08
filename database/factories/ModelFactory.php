<?php

$factory->define(App\Models\User::class, function ($faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => str_random(10),
        'location' => $faker->location,
        'remember_token' => str_random(10),
    ];
});
