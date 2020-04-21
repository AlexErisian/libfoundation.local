<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrintingCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('printing_comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('printing_id');
            $table->foreignId('user_id');
            $table->text('text');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('printing_id')->references('id')
                ->on('printings');
            $table->foreign('user_id')->references('id')
                ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('printing_comments');
    }
}
