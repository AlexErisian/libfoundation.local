<?php

use App\Models\PrintingComment;
use Illuminate\Database\Seeder;

class PrintingCommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(PrintingComment::class, 30)->create();
    }
}
