<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCellsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cells', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('row')->nullable();
            $table->integer('col')->nullable();

            $table->unsignedInteger('frame_id')->nullable();
            $table->index('frame_id');
            $table->foreign('frame_id')->references('id')->on('frames');

            $table->unsignedInteger('image_id')->nullable();
            $table->index('image_id');
            $table->foreign('image_id')->references('id')->on('images');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cells');
    }
}
