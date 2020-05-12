<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Printing;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(Printing::class, function (Faker $faker) {
    $title = $faker->unique()->sentence(rand(1, 6));
    $currentDateTime = Carbon::now()->toDateTimeString();
    return [
        'printing_author_id' => rand(1, 50),
        'printing_pubhouse_id' => rand(1, 50),
        'printing_type_id' => rand(1, 10),
        'title' => $title,
        'slug' => Str::slug($title),
        'publication_year' => rand(1950, 2020),
        'isbn' => rand(1, 5) > 1 ? $faker->isbn13 : null,
        'annotation' => $faker->realText(rand(100, 500)),
        'created_at' => $currentDateTime,
        'updated_at' => $currentDateTime,
    ];
});
