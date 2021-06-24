<?php

namespace Database\Seeders;

use App\Models\Director;
use Illuminate\Database\Seeder;

class DirectorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Director::create(['name' => 'Steven Spielberg']);
        Director::create(['name' => 'Martin Scorsese']);
        Director::create(['name' => 'Alfred Hitchcock']);
        Director::create(['name' => 'Stanley Kubrick']);
        Director::create(['name' => 'Quentin Tarantino']);
        Director::create(['name' => 'Orson Welles']);
        Director::create(['name' => 'Francis Ford Coppola']);
        Director::create(['name' => 'Ridley Scott']);
    }
}
