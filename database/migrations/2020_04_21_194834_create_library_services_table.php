<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLibraryServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('library_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('readercard_id');
            $table->integer('exemplars_given')->unsigned();
            $table->timestamps();
            $table->timestamp('given_up_to');
            $table->timestamp('returned_at')->nullable();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')
                ->on('users');
            $table->foreign('readercard_id')->references('id')
                ->on('readercards');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('library_services');
    }
}
