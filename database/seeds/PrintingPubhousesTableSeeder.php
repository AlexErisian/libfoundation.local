<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PrintingPubhousesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currentDateTime = Carbon::now()->toDateTimeString();
        $pubhouses = [];
        for ($i = 1; $i <= 50; $i++) {
            $pubhouses[] = [
                'name' => 'Видавництво № ' . $i,
                'created_at' => $currentDateTime,
                'updated_at' => $currentDateTime,
            ];
        }
        DB::table('printing_pubhouses')->insert($pubhouses);
    }
}
