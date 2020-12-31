<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

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
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => bcrypt('password'), // password
        'remember_token' => Str::random(10),
        'employee_number' => rand(1000,1999),
        'firstname' => $faker->firstName,
        'lastname' => $faker->lastName,
        'address' => $faker->address,
        'IC_number' => rand(870418016587,920418016587),
        'contact' => $faker->phoneNumber,
        'picture' => 'avatar.png',
        'department' => $faker->randomElement(["Finance","Production","Information"]),
        'basic_salary' => rand(1200,5000),
        'position' => $faker->randomElement(["E21 Manager","E15 Executive","E14 Engineer","P10 Analyst","E19 Assistant Manager","E10 Executive","E19 Engineer","P10 Analyst","E18 Engineer","P15 Analyst"]),
        'date_start_work' => now(),
        'date_resigned' => now(),
        'EPF_number' => 'EPF'.rand(42321,90231),
    ];
});
