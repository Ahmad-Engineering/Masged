<?php

namespace App\Http\Controllers;

use App\Models\TeacherCourse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TeacherCourseController extends Controller
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
     * @param  \App\Models\TeacherCourse  $teacherCourse
     * @return \Illuminate\Http\Response
     */
    public function show(TeacherCourse $teacherCourse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TeacherCourse  $teacherCourse
     * @return \Illuminate\Http\Response
     */
    public function edit(TeacherCourse $teacherCourse)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TeacherCourse  $teacherCourse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TeacherCourse $teacherCourse)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TeacherCourse  $teacherCourse
     * @return \Illuminate\Http\Response
     */
    public function destroy(TeacherCourse $teacherCourse)
    {
        $isDeleted = $teacherCourse->delete();

        if ($isDeleted) {
            return response()->json([
                'icon' => 'success',
                'text' => $teacherCourse->course_name . ' is successfully removed.',
                'title' => 'Successfully Removed',
            ], Response::HTTP_OK);
        }else {
            return response()->json([
                'icon' => 'error',
                'text' => $teacherCourse->course_name . ' failed to remove.',
                'title' => 'Failed Removing!',
            ], Response::HTTP_BAD_REQUEST);
        }
        //
    }
}
