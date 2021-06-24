<?php

namespace Database\Seeders;

use App\Models\Video;
use Illuminate\Database\Seeder;

class VideosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Video::create([
            'name' => 'The Movie',
            'description' => 'Really good movie for everyone.',
            'image' => 'https://www.infoplease.com/sites/infoplease.com/files/styles/scale600w/public/2020-11/hollywood.jpg?itok=csD1kUA-',
            'director_id' => 1,
        ]);
    }
}
