<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        //
        'post_id' => mt_rand(1, App\Post::all()->count()),
        'content' => $faker->text(500)
    ];
});
