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
        Manager::factory(10)->create();
        Masged::factory(10)->create();
        Student::factory(10)->create();
        Teacher::factory(10)->create();
        Course::factory(10)->create();
        Quran::factory(10)->create();
        Degree::factory(10)->create();

        
        QuranStudent::factory(10)->create();
        StudentCourse::factory(10)->create();
        StudentTeacher::factory(10)->create();
        TeacherCourse::factory(10)->create();
    }
}
