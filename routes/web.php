<?php

use App\Http\Controllers\AddStudentToCourse;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\MasgedController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TeacherCourseController;
use App\Models\TeacherCourse;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('masged')->group(function () {
    Route::get('{guard}/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('login', [AuthController::class, 'login']);
});

Route::prefix('masged/manager/')->middleware('auth:manager')->group(function () {
    Route::view('/', 'admin.parent')->name('admin.parent');

    Route::resource('/teacher', TeacherController::class);
    Route::resource('/masged', MasgedController::class);
    Route::resource('/student', StudentController::class);
    Route::resource('/course', CourseController::class);
    Route::resource('/teacher-course', TeacherCourseController::class);

    Route::get('{course}/addcourse', [CourseController::class, 'showAddCourse'])->name('add.course');
    Route::post('{course}/addcourse/{teacher}/', [CourseController::class,'addCourse']);

    Route::get('{course}/addstudent', [AddStudentToCourse::class, 'showAddingStudent'])->name('add.student');
    Route::post('{course}/addstudent/{student}/', [AddStudentToCourse::class,'addStudent']);

    Route::get('/show-teacher-courses', [TeacherController::class, 'showTeacherCourses'])->name('show.teacher.courses');

    Route::get('/show-student-courses', [StudentController::class, 'showStudentCourses'])->name('show.student-courses');

    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});