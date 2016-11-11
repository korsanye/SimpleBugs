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


$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});


$factory->define(App\Models\Project::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->company,

    ];
});

$factory->define(App\Models\Milestone::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'milestone' => $faker->dateTimeThisYear,
    ];
});


$factory->define(App\Models\Issue::class, function (Faker\Generator $faker) {
    return [
        'user_id' => function() { return factory(App\Models\User::class)->create()->id; },
        'project_id' => function() { return factory(App\Models\Project::class)->create()->id; },
        'category_id' => random_int(1,2),
        'priority_id' => random_int(1,4),
        'milestone_id' => function() { return factory(App\Models\Milestone::class)->create()->id; },
        'created_by' => function() { return factory(App\Models\User::class)->create()->id; },
        'title' => $faker->realText(100, 2),
        'description' => $faker->sentences(random_int(2,5), true),
        'estimate' => random_int(60, 7200),
        'time_spent' => random_int(60, 7200),
        'closed' => (boolean)random_int(0,1),
    ];
});


$factory->define(App\Models\Post::class, function (Faker\Generator $faker) {
    return [
        'issue_id' => function() { return factory(App\Models\Issue::class)->create()->id; },
        'user_id' => function() { return factory(App\Models\User::class)->create()->id; },
        'content' => $faker->sentences(random_int(2,5), true),
    ];
});