<?php

namespace Database\Seeders;

use App\Models\Star;
use Illuminate\Database\Seeder;

class StarsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Star::create(['name' => 'Robert De Niro']);
        Star::create(['name' => 'Jack Nicholson']);
        Star::create(['name' => 'Marlon Brando']);
        Star::create(['name' => 'Denzel Washington']);
        Star::create(['name' => 'Katharine Hepburn']);
        Star::create(['name' => 'Humphrey Bogart']);
        Star::create(['name' => 'Meryl Streep']);
        Star::create(['name' => 'Daniel Day-Lewis']);
    }
}
