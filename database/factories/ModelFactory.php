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

use App\User;
use App\Subject;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Subject::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->word,
        'slug' => $faker->word
    ];
});

$factory->define(App\Post::class, function (Faker\Generator $faker) {
    $title = $faker->sentence;

    return [
        'subject_id' => factory(Subject::class)->lazy(),
        'date' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'title' => $title,
        'slug' => str_slug($title),
        'content' => $faker->realText(400),
        'published' => $faker->boolean(80)
    ];
});

$factory->state(App\Post::class, 'published', function (Faker\Generator $faker) {

    return [
        'published' => 1
    ];
});

$factory->state(App\Post::class, 'unpublished', function (Faker\Generator $faker) {

    return [
        'published' => 0
    ];
});
