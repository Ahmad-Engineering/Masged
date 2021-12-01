<?php

use App\Models\Masged;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// use Symfony\Component\HttpFoundation\Response;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('welcome', function () {


    // $data = Teacher::all();
    // $data = Student::all();
    // $data = Masged::all();

    // $data = Teacher::max('age');
    // $data = Teacher::max('age');


    // $data = Masged::max('created_at');
    // $data = Masged::max('updated_at');

    // $data = Masged::min('created_at');
    // $data = Masged::max('updated_at');
    
    // $data = Teacher::min('age');

    // $data = Student::max('age');
    // $data = Student::min('age');

    // Teacher AVG
    // $data = Teacher::avg('age');

    // Student AVG
    // $data = Student::avg('age');

    // Student Count
    // $data = Student::count();

    // Teacher count
    // $data = Teacher::count();

    // Masged count
    // $data = Masged::count();

    // Where -> Student
    // $data = Student::all();
    // $data = Student::where('id', '=', 176)->get();
    // $data = Student::where('id', 176)->get();
    // $data = Student::where('id', '>', 176)->get();
    // $data = Student::where('id', '>=', 176)->get();
    // $data = Student::where('id', '<', 176)->get();
    // $data = Student::where('id', '<=', 176)->get();

    // Where -> Teacher
    // $data = Teacher::all();
    // $data = Teacher::where('id', '=', 18)->get();
    // $data = Teacher::where('id', 18)->get();
    // $data = Teacher::where('id', '>', 18)->get();
    // $data = Teacher::where('id', '>=', 18)->get();
    // $data = Teacher::where('id', '<', 18)->get();
    // $data = Teacher::where('id', '<=', 18)->get();

    // Where -> Masged
    // $data = Masged::all();
    // $data = Masged::where('id', '=', 4)->get();
    // $data = Masged::where('id', 4)->get();
    // $data = Masged::where('id', '>', 4)->get();
    // $data = Masged::where('id', '>=', 4)->get();
    // $data = Masged::where('id', '<', 4)->get();
    // $data = Masged::where('id', '<=', 4)->get();



    // Where , count -> Student
    // $data = Student::all();
    // $data = Student::where('id', 180)->get(); ==> Student Data
    // $data = Student::where('id', 180)->count();
    // $data = Student::where('age', 34)->get(); ==> Student data whose his age equal 34
    // $data = Student::where('age', 35)->count(); ==> Number Student data whose his age equal 34

    // Where , count -> Teacher
    // $data = Teacher::where('age', 34)->get(); ==> Teacher data whose his age equal 34
    // $data = Teacher::where('age', 34)->count(); ==> Number Teacher data whose his age equal 34

    // Where , count -> Masged
    // $data = Masged::all();
    // $data = Masged::where('name', 'asd')->get(); ==> Masged data whose his age equal 34
    // $data = Masged::where('name', 'asd')->count(); ==> Number Masged data whose his age equal 34

    // Take, all -> Student
    // $data = Student::take(10)->all(); ==> Wrong Statement
    // $data = Student::all()->take(10);

    // Take, get -> Student
    // $data = Student::take(10)->get(); ==> The best statement 
    // $data = Student::get()->take(10);

    // Take, all -> Teacher
    // $data = Teacher::all();
    // $data = Teacher::take(10)->all(); ==> Wrong Statement
    // $data = Teacher::all()->take(10);

    // Take, get -> Teacher
    // $data = Teacher::take(10)->get();
    // $data = Teacher::get()->take(10);

    // Take, all -> Masged
    // $data = Masged::take(10)->all(); ==> Wrong Satement
    // $data = Masged::all()->take(10);

    // Take, get -> Masged
    // $data = Masged::get()->take(10);
    // $data = Masged::take(10)->get();

    // Skip, Take, all -> Student
    // $data = Student::all()->take(10)->skip(10); ==> Take 10 Student, after that skip the same student
    // $data = Student::all()->skip(10)->take(10); ==> Skip 10 student from all student, after this take 10 students
    // $data = Student::skip(10)->all()->take(10); ==> Wrong Statement

    // Skip, Take, all -> Teacher
    // $data = Teacher::all()->take(10)->skip(10); ==> Take 10 Teacher, after that skip the same Teacher
    // $data = Teacher::all()->skip(10)->take(10); ==> Skip 10 Teacher from all Teacher, after this take 10 Teacher
    // $data = Teacher::skip(10)->all()->take(10); ==> Wrong Statement

    // Skip, Take, all -> Masged
    // $data = Masged::all()->take(10)->skip(10); ==> Take 10 Masged, after that skip the same Masged
    // $data = Masged::all()->skip(10)->take(10); ==> Skip 10 Masged from all Masged, after this take 10 Masged
    // $data = Masged::skip(10)->all()->take(10); ==> Wrong Statement

    // Skip, Take, get -> Student
    // $data = Student::take(10)->get();
    // $data = Student::take(10)->skip(10)->get();
    // $data = Student::skip(10)->take(10)->get();
    // $data = Student::skip(10)->get(); ==> Wrong Statement

    // Skip, Take, get -> Teacher
    // $data = Teacher::take(10)->get();
    // $data = Teacher::take(10)->skip(10)->get();
    // $data = Teacher::skip(40)->take(20)->get();

    // Skip, Take, get -> Masged
    // $data = Masged::take(10)->get();
    // $data = Masged::take(10)->skip(10)->get();
    // $data = Masged::skip(60)->take(32)->get();

    // Limit, offset, get -> Student
    // $data = Student::take(10)->get();
    // $data = Student::limit(10)->get();
    // $data = Student::offset(10)->get(); ==> Wrong Statement
    // $data = Student::all()->offset(10)->get(); ==> Wrong Statement
    // $data = Student::limit(10)->offset(10)->get();
    // $data = Student::offset(10)->limit(10)->get();

    // Limit, offset, get -> Teacher
    // $data = Teacher::limit(10)->get();
    // $data = Teacher::offset(10)->get(); ==> Wrong Statement
    // $data = Teacher::limit(10)->offset(10)->get();
    // $data = Teacher::offset(10)->limit(10)->get();

    // Limit, offset, get -> Masged
    // $data = Masged::limit(10)->get();
    // $data = Masged::offset(10)->get(); ==> Wrong Statement
    // $data = Masged::limit(10)->offset(10)->get();
    // $data = Masged::offset(10)->limit(10)->get();

    // Limit, offset, all -> Student
    // Limit, offset, all -> Teacher
    // Limit, offset, all -> Masged
    // $data = Student::all()->offset(10); ==> Wrong Statement
    // $data = Student::all()->limit(10); ==> Wrong Statement

    // $data = Student::limit(10)->offset(10)->limit(20)->offset(20)->get();
    // $data = Teacher::limit(10)->offset(10)->limit(20)->offset(20)->get();
    // $data = Masged::limit(10)->offset(10)->limit(20)->offset(20)->get();



    
    // return response()->json([
    //     $data
    // ]);


});