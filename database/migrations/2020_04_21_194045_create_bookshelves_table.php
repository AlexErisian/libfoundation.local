<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookshelvesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookshelves', function (Blueprint $table) {
            $table->id();
            $table->foreignId('library_id')->constrained();
            $table->foreignId('printing_id')->constrained();
            $table->integer('exemplars_registered')->unsigned();
            $table->integer('exemplars_in_stock')->unsigned();
            $table->integer('shelf_number')->unsigned()->nullable();
            $table->integer('shelf_floor')->unsigned()->nullable();
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
        Schema::dropIfExists('bookshelves');
    }
}
