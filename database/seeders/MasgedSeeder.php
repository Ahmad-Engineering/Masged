<?php

namespace Database\Seeders;

use App\Models\Masged;
use Illuminate\Database\Seeder;

class MasgedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Masged::factory(100)->create();
    }
}
