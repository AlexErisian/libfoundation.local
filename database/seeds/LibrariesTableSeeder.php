<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class LibrariesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Creating records for test
        $currentDateTime = Carbon::now()->toDateTimeString();
        $libraries = [];
        for ($i = 1; $i <= 10; $i++) {
            $libraries[] = [
                'name' => 'Бібліотека № ' . $i,
                'address' => 'Тестова адреса',
                'notes' => 'Тестова інформація',
                'created_at' => $currentDateTime,
                'updated_at' => $currentDateTime,
            ];
        }
        DB::table('libraries')->insert($libraries);
    }
}
