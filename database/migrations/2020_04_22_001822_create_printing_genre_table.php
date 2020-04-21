<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrintingGenreTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('printing_genre', function (Blueprint $table) {
            $table->id();
            $table->foreignId('printing_id');
            $table->foreignId('printing_genre_id');

            $table->foreign('printing_id')->references('id')
                ->on('printings');
            $table->foreign('printing_genre_id')->references('id')
                ->on('printing_genres');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('printing_genre');
    }
}
