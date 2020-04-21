<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrintingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('printings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('printing_author_id');
            $table->foreignId('printing_pubhouse_id');
            $table->foreignId('printing_type_id');
            $table->string('title');
            $table->timestamp('published_at');
            $table->text('annotation');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('printing_author_id')
                ->references('id')
                ->on('printing_authors');
            $table->foreign('printing_pubhouse_id')
                ->references('id')
                ->on('printing_pubhouses');
            $table->foreign('printing_type_id')
                ->references('id')
                ->on('printing_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('printings');
    }
}
