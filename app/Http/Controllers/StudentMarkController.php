<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Masged;
use App\Models\Student;
use Illuminate\Http\Request;


class StudentMarkController extends Controller
{
    //

    public function showStudentPage ($id) {
        $masged = Masged::where('manager_id', auth()->user()->id)->first();
        $count = Course::Where('masged_name', $masged->name)
        ->where('id', $id)
        ->count();

        if ($count == 0)
            return redirect()->view('admin.student.show-courses'); 

        $students = Student::Where('masged_name', $masged->name)
        ->with(['courses' => function ($query) use($id) {
            $query->where('course_id', $id);
        }])
        ->get();

        return response()->view('admin.student.student-course-mark', ['students' => $students]);
    }
}
