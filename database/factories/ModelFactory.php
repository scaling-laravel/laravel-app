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
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});


$factory->define(App\Customer::class, function (Faker\Generator $faker) {
    return [
        'user_id' => function() {
            return factory(App\User::class)->create();
        },
        'hash' => str_random(64),
    ];
});


$factory->define(App\Pageview::class, function (Faker\Generator $faker) {;
    $date = $faker->dateTimeBetween('-120 days', 'now');
    return [
        'customer_id' => 1, // Def over-ride this
        'user_id' => 1, // Def over-ride this
        'uri' => '/'.$faker->slug,
        'domain' => $faker->domainName,
        'updated_at' => $date,
        'created_at' => $date,
    ];
});