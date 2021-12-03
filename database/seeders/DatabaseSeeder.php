<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Degree;
use App\Models\Manager;
use App\Models\Masged;
use App\Models\Quran;
use App\Models\QuranStudent;
use App\Models\Student;
use App\Models\StudentCourse;
use App\Models\StudentTeacher;
use App\Models\Teacher;
use App\Models\TeacherCourse;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        Masged::factory(100)->create();
        Manager::factory(100)->create();
        Student::factory(300)->create();
        Teacher::factory(300)->create();
        Course::factory(100)->create();
        Quran::factory(100)->create();
        Degree::factory(300)->create();

        
        QuranStudent::factory(100)->create();
        StudentCourse::factory(100)->create();
        StudentTeacher::factory(100)->create();
        TeacherCourse::factory(100)->create();
    }
}
