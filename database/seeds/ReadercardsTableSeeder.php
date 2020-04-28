<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ReadercardsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currentDateTime = Carbon::now()->toDateTimeString();
        $readercards = [
            [
                'code' => 1,
                'notes' => 'Admin\'s testing card',
                'created_at' => $currentDateTime,
                'updated_at' => $currentDateTime,
            ],
            [
                'code' => 100001,
                'notes' => 'Librarian\'s card',
                'created_at' => $currentDateTime,
                'updated_at' => $currentDateTime,
            ],
            [
                'code' => 100002,
                'notes' => 'Reader\'s card',
                'created_at' => $currentDateTime,
                'updated_at' => $currentDateTime,
            ],
        ];
        DB::table('readercards')->insert($readercards);
    }
}
