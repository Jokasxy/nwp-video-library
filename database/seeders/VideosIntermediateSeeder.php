<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VideosIntermediateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('videos_stars')->insert([
            'video_id' => 1,
            'star_id' => 1,
        ]);
        DB::table('videos_stars')->insert([
            'video_id' => 1,
            'star_id' => 2,
        ]);

        DB::table('videos_genres')->insert([
            'video_id' => 1,
            'genre_id' => 1,
        ]);
        DB::table('videos_genres')->insert([
            'video_id' => 1,
            'genre_id' => 2,
        ]);
    }
}
