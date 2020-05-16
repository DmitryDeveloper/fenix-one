<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, static function (Faker $faker) {
    return [
        'text' => $faker->realText(random_int(20, 40), 1),
        'created_at' => now(),
        'updated_at' => now()
    ];
});
