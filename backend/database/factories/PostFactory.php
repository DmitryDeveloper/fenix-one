<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, static function (Faker $faker) {
    return [
        'title' => $faker->sentence(random_int(3, 7), true),
        'text' => $faker->realText(random_int(50, 150), 2),
        'created_at' => now(),
        'updated_at' => now()
    ];
});
