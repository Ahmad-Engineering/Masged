<?php

namespace Database\Seeders;

use App\Models\QuranStudent;
use Illuminate\Database\Seeder;

class QuranStudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        QuranStudent::factory(100)->create();
    }
}
