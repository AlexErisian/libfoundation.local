<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrintingWritingOffsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('printing_writing_offs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('library_printing_id');
            $table->integer('exemplars_written_off')->unsigned();
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')
                ->on('users');
            $table->foreign('library_printing_id')->references('id')
                ->on('library_printing');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('printing_writing_offs');
    }
}
