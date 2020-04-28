<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PrintingTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currentDateTime = Carbon::now()->toDateTimeString();
        $types = [];
        for ($i = 1; $i <= 10; $i++) {
            $types[] = [
                'name' => 'Тип видання № ' . $i,
                'created_at' => $currentDateTime,
                'updated_at' => $currentDateTime,
            ];
        }
        DB::table('printing_types')->insert($types);
    }
}
