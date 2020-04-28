<?php

use Illuminate\Database\Seeder;

class PrintingGenreTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $records = [];
        for ($i = 1; $i <= 300; $i++) {
            $records[] = [
                'printing_id' => $i,
                'printing_genre_id' => rand(1,10),
            ];
        }
        DB::table('printing_genre')->insert($records);
    }
}
