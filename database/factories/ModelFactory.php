<?php

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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Pupil::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'currPoints' => $faker->numberBetween(0,200),
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Tutorgroup::class, function (Faker\Generator $faker) {
    $string = "";
    for ($letter = 1; $letter <= 3; $letter++) {
        $faker = Faker\Factory::create();
        $string = $string . $faker->randomLetter();
    }
    return [
        'house_id' => 1,
        'name' => $faker->numberBetween(7,13) . strtoupper($string),
        'currPoints' => $faker->numberBetween(0,200),
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\House::class, function (Faker\Generator $faker) {
    return [
        'name' => strtoupper($faker->word),
        'colour' => $faker->safeHexColor,
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Year::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->numberBetween(7,13)
    ];
});


