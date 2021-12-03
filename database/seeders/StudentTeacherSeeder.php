<?php

namespace Database\Seeders;

use App\Models\StudentTeacher;
use Illuminate\Database\Seeder;

class StudentTeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        StudentTeacher::factory(100)->create();
    }
}
