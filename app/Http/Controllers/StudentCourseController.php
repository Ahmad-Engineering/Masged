<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Masged;
use App\Models\Student;
use App\Models\StudentCourse;
use GuzzleHttp\RetryMiddleware;
use Illuminate\Http\Request;

class StudentCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StudentCourse  $studentCourse
     * @return \Illuminate\Http\Response
     */
    public function show(StudentCourse $studentCourse)
    {
        //
        // dd($studentCourse);


        // $masged  = Masged::where('manager_id', auth()->user()->id)->first();

        // $count = Course::where('masged_name', $masged->name)
        // ->where('id', $studentCourse->id)
        // ->count();

        // if ($count == 0) 
        //     return redirect()->route('show.student.courses');


        // $course_id = $studentCourse->id;

        // // $students = StudentCourse::where('course_name', $studentCourse->name)->get();
        // $students = Student::where('masged_name', $masged->name)
        // ->with(['courses' => function ($query) use($course_id) {
        //     $query->where('course_id', $course_id);
        // }])
        // ->get();

        // return response()->view('admin.student.student-course', ['students' => $students]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StudentCourse  $studentCourse
     * @return \Illuminate\Http\Response
     */
    public function edit(StudentCourse $studentCourse)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StudentCourse  $studentCourse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StudentCourse $studentCourse)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StudentCourse  $studentCourse
     * @return \Illuminate\Http\Response
     */
    public function destroy(StudentCourse $studentCourse)
    {
        $isDeleted = $studentCourse->delete();
        //

        if ($isDeleted) {
            return response()->json([
                'icon' => 'success',
                'title' => 'Success!',
                'text' => 'Student removed successfully.',
            ]);
        }else {
            return response()->json([
                'icon' => 'error',
                'title' => 'Failed!',
                'text' => 'Failed to remove student from this course',
            ]);
        }
    }
}
