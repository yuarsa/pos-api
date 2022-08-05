<?php
use Illuminate\Support\Facades\Hash;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\Models\Auth\User::class, function (Faker\Generator $faker) {
    return [
        'uuid' => str_random(32),
        'username' => $faker->username,
        'email' => $faker->email,
        'name' => $faker->name,
        'password' => Hash::make('1234'),
        'activation_token' => str_random(32),
        'enabled' => 1,
        'type' => 's',
        'value_id' => 0,
    ];
});
