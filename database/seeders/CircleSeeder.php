<?php

namespace Database\Seeders;

use App\Models\Circle;
use Illuminate\Database\Seeder;

class CircleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Circle::factory(100)->create();
    }
}
