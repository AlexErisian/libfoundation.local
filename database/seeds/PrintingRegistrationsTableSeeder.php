<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PrintingRegistrationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currentDateTime = Carbon::now()->toDateTimeString();
        $nbInitially = DB::table('library_printing')
            ->pluck('exemplars_registered');
        $registrations = [];
        for ($i = 1; $i <= 300; $i++) {
            $registrations[] = [
                'user_id' => 2,
                'library_printing_id' => $i,
                'exemplars_registered_initially' => $nbInitially[$i-1],
                'created_at' => $currentDateTime,
                'updated_at' => $currentDateTime,
            ];
        }
        DB::table('printing_registrations')->insert($registrations);
    }
}
