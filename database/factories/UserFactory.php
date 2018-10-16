<?php

use App\User;
use App\Topic;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $name = $faker->name,
        'email' => snake_case($name) . '@laravellive.in',
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});

$factory->afterCreating(User::class, function ($user, $faker) {
    $topic = $user->topics()->save(Topic::inRandomOrder()->first());
    $topic->votes()->attach($user->id);
});
