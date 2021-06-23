<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideosStarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos_stars', function (Blueprint $table) {
            $table->foreignId('video_id');
            $table->foreignId('star_id');

            $table->foreign('video_id')->references('id')->on('videos')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('star_id')->references('id')->on('stars')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('videos_stars');
    }
}
