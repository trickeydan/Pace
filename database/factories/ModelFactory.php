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
$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Pupil::class, function (Faker\Generator $faker) {
    return [
        'forename' => $faker->firstName,
        'surname' => $faker->lastName,
        'adno' => $faker->numberBetween(1000,9999),
        'currPoints' => $faker->numberBetween(0,200),
    ];
});

$factory->define(App\Models\Teacher::class, function (Faker\Generator $faker) {
    $string = "";
    for ($letter = 1; $letter <= 3; $letter++) {
        $faker = Faker\Factory::create();
        $string = $string . $faker->randomLetter();
    }
    //Todo: Stop re-using this piece of code. Make a function randomInitials() somewhere
    return [
        'name' => $faker->name,
        'initials' => strtoupper($string),
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Tutorgroup::class, function (Faker\Generator $faker) {
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
$factory->define(App\Models\House::class, function (Faker\Generator $faker) {
    return [
        'name' => strtoupper($faker->word),
        'colour' => $faker->safeHexColor,
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Year::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->numberBetween(7,13)
    ];
});

$factory->define(App\Models\PupilPoint::class,function (Faker\Generator $faker){
   return [
       'date' => $faker->date(),
       'pupil_id' => null,
       'amount' => $faker->numberBetween(1,5),
       'description' => $faker->sentence,
       'pupil_point_type_id' => null

   ];
});

$factory->define(App\Models\PupilPointType::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word,
    ];
});

$factory->define(App\Models\Administrator::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
    ];
});