<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLibraryPrintingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('library_printing', function (Blueprint $table) {
            $table->id();
            $table->foreignId('library_id')->constrained();
            $table->foreignId('printing_id')->constrained();
            $table->integer('exemplars_registered')->unsigned();
            $table->integer('exemplars_stored')->unsigned();
            $table->integer('rack_number')->unsigned()->nullable();
            $table->integer('rack_floor')->unsigned()->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('library_printing');
    }
}
