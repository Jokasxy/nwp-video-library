<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideosGenresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos_genres', function (Blueprint $table) {
            $table->foreignId('video_id');
            $table->foreignId('genre_id');

            $table->foreign('video_id')->references('id')->on('videos')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('genre_id')->references('id')->on('genres')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('videos_genres');
    }
}
