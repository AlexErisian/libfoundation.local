<?php

use App\Models\Printing;
use Illuminate\Database\Seeder;

class PrintingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Creating records for test
        factory(Printing::class, 300)->create();
    }
}
