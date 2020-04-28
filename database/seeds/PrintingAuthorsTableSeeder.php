<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PrintingAuthorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currentDateTime = Carbon::now()->toDateTimeString();
        $authors = [];
        for ($i = 1; $i <= 50; $i++) {
            $authors[] = [
                'name' => 'Автор № ' . $i,
                'created_at' => $currentDateTime,
                'updated_at' => $currentDateTime,
            ];
        }
        DB::table('printing_authors')->insert($authors);
    }
}
