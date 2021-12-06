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
        Masged::factory(5)->create();
        Manager::factory(5)->create();
        Student::factory(5)->create();
        Teacher::factory(5)->create();
        Course::factory(5)->create();
        Quran::factory(5)->create();
        Degree::factory(5)->create();

        
        QuranStudent::factory(5)->create();
        StudentCourse::factory(5)->create();
        StudentTeacher::factory(5)->create();
        TeacherCourse::factory(5)->create();
    }
}
