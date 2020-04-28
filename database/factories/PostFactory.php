<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    $title = $faker->sentence(rand(3, 8));
    $description = $faker->realText(rand(500, 1000));
    $content = $description . $faker->realText(rand(1000, 4000));
    $isPublished = rand(1, 20) > 3;
    $createdAt = $faker->dateTimeBetween('-1 week', '-1 day');
    $publishedAt = null;
    if ($isPublished) {
        $publishedAt = new DateTime($createdAt->format(DateTime::W3C));
        $interval = rand(10, 3600);
        $publishedAt->add(DateInterval::createFromDateString($interval .
            ' seconds'));
    }

    return [
        'user_id' => rand(1, 2),
        'title' => $title,
        'slug' => Str::slug($title),
        'description' => $description,
        'content' => $content,
        'is_published' => $isPublished,
        'created_at' => $createdAt,
        'updated_at' => $createdAt,
        'published_at' => $publishedAt,
    ];
});
