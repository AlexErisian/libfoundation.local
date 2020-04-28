<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\PrintingComment;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(PrintingComment::class, function (Faker $faker) {
    $currentDateTime = Carbon::now()->toDateTimeString();

    return [
        'printing_id' => rand(1,300),
        'user_id' => rand(1,3),
        'text' => $faker->realText(rand(100, 1000)),
        'created_at' => $currentDateTime,
        'updated_at' => $currentDateTime,
    ];
});
