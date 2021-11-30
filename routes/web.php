<?php

use App\Http\Controllers\MasgedController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
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

Route::prefix('masged/admin/')->group(function () {
    Route::view('/', 'admin.parent')->name('admin.parent');
    Route::resource('/teacher', TeacherController::class);
    Route::resource('/masged', MasgedController::class);
    Route::resource('/student', StudentController::class);
});