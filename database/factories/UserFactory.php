<?php

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

//User table data seeder
$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});

//subscriber table data seeder
$factory->define(App\Subscriber::class, function (Faker $faker) {

	$state = array('active', 'unsubscribed', 'junk', 'bounced', 'unconfirmed');
	// get random index from $state array
	$randIndex = array_rand($state);
    return [
        'name' => $faker->name,
        'email_address' => $faker->email,
        'state' => $state[$randIndex],
    ];
});

//Filed table data seeder
$factory->define(App\Field::class, function (Faker $faker) {

	$type = array('date', 'number', 'string', 'boolean');
	// get random index from $type array
	$randIndex = array_rand($type);

    return [
        'title' => $faker->sentence,
        'type' => $type[$randIndex],
    ];
});
