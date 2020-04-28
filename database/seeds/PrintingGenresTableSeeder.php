<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PrintingGenresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currentDateTime = Carbon::now()->toDateTimeString();
        $genres = [];
        for ($i = 1; $i <= 10; $i++) {
            $genres[] = [
                'name' => 'Жанр № ' . $i,
                'created_at' => $currentDateTime,
                'updated_at' => $currentDateTime,
            ];
        }
        DB::table('printing_genres')->insert($genres);
    }
}
