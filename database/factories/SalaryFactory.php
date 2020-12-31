<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Salary;
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

$factory->define(Salary::class, function (Faker $faker) {
    return [
        'user_id' => rand(37,56),
        'year' => rand(2018,2020),
        'month' => rand(1,12),
        'amount_paid' => rand(1800,5000), // password
        'paid_date' => now(),
        'allowances' => rand(0,500),
        'overtime' => rand(0,500),
        'deduction' => rand(0,400),
    ];
});
