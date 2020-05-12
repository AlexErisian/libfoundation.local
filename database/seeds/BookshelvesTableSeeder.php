<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class BookshelvesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currentDateTime = Carbon::now()->toDateTimeString();
        $records = [];
        for ($i = 1; $i <= 300; $i++) {
            $nbExemplars = rand(1, 50);
            $records[] = [
                'library_id' => rand(1, 10),
                'printing_id' => $i,
                'exemplars_registered' => $nbExemplars,
                'exemplars_in_stock' => $nbExemplars,
                'shelf_number' => rand(1, 100),
                'shelf_floor' => rand(1, 20),
                'notes' => 'Test record',
                'created_at' => $currentDateTime,
                'updated_at' => $currentDateTime,
            ];
        }
        DB::table('bookshelves')->insert($records);
    }
}
