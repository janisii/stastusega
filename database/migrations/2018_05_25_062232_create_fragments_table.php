<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateFragmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fragments', function (Blueprint $table) {
            //
            $table->increments('id');
            $table->string('name');
            $table->string('image_file')->nullable();
            $table->string('image_file_ori')->nullable();
            $table->string('image_background_hex')->nullable();
            $table->string('course')->nullable();
            $table->string('living_location')->nullable();
            $table->text('story')->nullable();
            $table->boolean('anonymous')->default(false);
            $table->boolean('active')->default(true);

            // relation
            $table->unsignedInteger('user_id');
            $table->index('user_id');
            $table->foreign('user_id')->references('id')->on('users');

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
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        Schema::dropIfExists('fragments');

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
