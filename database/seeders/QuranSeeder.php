<?php

namespace Database\Seeders;

use App\Models\Quran;
use Illuminate\Database\Seeder;

class QuranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Quran::factory(100)->create();
    }
}
