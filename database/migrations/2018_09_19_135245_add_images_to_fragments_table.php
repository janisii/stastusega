<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddImagesToFragmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fragments', function (Blueprint $table) {
            // relation to images
            $table->dropColumn('image_file');
            $table->dropColumn('image_file_ori');
            $table->dropColumn('image_background_hex');
            $table->unsignedInteger('image_id')->after('active')->nullable();
            $table->index('image_id');
            $table->foreign('image_id')->references('id')->on('images');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fragments', function (Blueprint $table) {
            //
        });
    }
}
