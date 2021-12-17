<?php

use App\Http\Controllers\AddStudentToCourse;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CircleController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\MarkController;
use App\Http\Controllers\MasgedController;
use App\Http\Controllers\QuranController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentCourseController;
use App\Http\Controllers\StudentMarkController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TeacherCourseController;
use App\Models\Circle;
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
    // Route::view('/', 'admin.parent')->name('admin.parent');

    Route::get('/', [StudentController::class, 'userNumbers'])->name('admin.parent');

    // Route::get('/student-number', [StudentController::class, 'studentNumbers'])->name('student.no');

    Route::resource('/teacher', TeacherController::class);
    Route::resource('/masged', MasgedController::class);
    Route::resource('/student', StudentController::class);
    Route::resource('/course', CourseController::class);
    Route::resource('/teacher-course', TeacherCourseController::class);
    Route::resource('/student-course', StudentCourseController::class);
    Route::resource('/circle', CircleController::class);
    Route::resource('/quran-circle', QuranController::class);

    Route::get('{course}/addcourse', [CourseController::class, 'showAddCourse'])
    ->name('add.course');
    Route::post('{course}/addcourse/{teacher}/', [CourseController::class,'addCourse']);

    Route::get('{course}/addstudent', [AddStudentToCourse::class, 'showAddingStudent'])
    ->name('add.student');
    Route::post('{course}/addstudent/{student}/', [AddStudentToCourse::class,'addStudent']);

    Route::get('/show-teacher-courses', [TeacherController::class, 'showTeacherCourses'])
    ->name('show.teacher.courses');

    Route::get('/show-student-courses', [StudentController::class, 'showStudentCourses'])
    ->name('show.student.courses');
    // Route::get('/show-student-courses/{id}', 
    // [StudentController::class, 'showStudent'])
    // ->name('show.student.of.course');

    Route::get('/show-student-mark/{id}/course', [StudentMarkController::class, 'showStudentPage'])->name('show.student.mark.page');
    Route::get('/show-student-mark/{course_id}/course/{student_id}/student', [StudentMarkController::class, 'showMarkPage'])->name('give.mark.from.admin');
    Route::post('/show-student-mark/submit-mark', [StudentMarkController::class, 'submitMark']);

    Route::get('/student-marks/show', [MarkController::class, 'showCourses'])->name('student.marks.course');
    Route::get('/student-marks/show/{course_id}/course', [MarkController::class, 'showMarks'])->name('show.student.marks.in.course');

    Route::get('/circle-brows/{id}/circle', [QuranController::class, 'getCircle'])->name('spacific.circle');
    Route::get('/circle-brows/{circleId}/circle/{studentId}', [QuranController::class, 'returnStuedntDetaislWithCircle'])->name('spacific.student.in.circle');
    // Route::post('/circle-brows/{id}/circle/{id}/student', [QuranController::class, 'addQuran']);
    Route::post('/circle-brows/circle/add', [QuranController::class, 'addQuran']);

    Route::get('/add-student-to-circle/{id}/circle/', [CircleController::class, 'addStudentToCircle'])->name('add.student.to.circle');
    Route::post('/add-student-to-circle/submit', [CircleController::class, 'addSpacificStudentToCircle']);

    Route::get('/show-student-circle/{id}/circle', [CircleController::class, 'showStudentCircle'])->name('show.student.circle');
    Route::post('/show-student-circle/remove', [CircleController::class, 'removeStudentFromCircle']);

    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});