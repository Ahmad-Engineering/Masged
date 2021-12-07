<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Masged;
use Dotenv\Validator;
use GrahamCampbell\ResultType\Result;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $masged = Masged::where('manager_id', auth()->user()->id)->first();
        $data = Course::where('masged_name', $masged->name)->get();
        return response()->view('admin.course.index', ['courses' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return response()->view('admin.course.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator($request->all(), [
            'name' => 'required|string|min:3|max:40|unique:courses',
            'info' => 'string|min:10|max:100',
            'status' => 'required|boolean'
        ]);
        //
        if (!$validator->fails()) {
            $masged = Masged::where('manager_id', auth()->user()->id)->first();

            $course = new Course();
            $course->name = $request->get('name');
            $course->info = $request->get('info');
            $course->masged_name = $masged->name;
            $course->status = $request->get('status');

            $isCreated = $course->save();

            return response()->json([
                'message' => $isCreated ? 'Course created successfully' : 'Failed to create course'
            ], $isCreated ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
        }else {
            return response()->json([
                'message' => 'Failed to create course'
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        //
        return response()->view('admin.course.edit', ['course' => $course]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        $validator = null;
        if ($course->name == $request->get('name')) {
            $validator = Validator($request->all(), [
                // 'name' => 'required|string|min:3|max:40|unique:courses',
                'info' => 'string|min:10|max:100',
                'status' => 'required|boolean'
            ]);
        }else {
            $validator = Validator($request->all(), [
                'name' => 'required|string|min:3|max:40|unique:courses',
                'info' => 'string|min:10|max:100',
                'status' => 'required|boolean'
            ]);
        }
        //

        if (!$validator->fails()) {
            $course->name = $request->get('name');
            $course->info = $request->get('info');
            $course->status = $request->get('status');

            $isUpdated = $course->save();
            
            return response()->json([
                'message' => $isUpdated ? 'Course updated successfully' : 'Failed to update course' 
            ], $isUpdated ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
        }else {
            return response()->json([
                'message' => 'Failed to update course'
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        //
        $isDeleted = $course->delete();

        if ($isDeleted) {
            return response()->json([
                'title' => 'Deleted!',
                'text' => 'Course deleted successfully',
                'icon' => 'success'
            ], Response::HTTP_OK);
        }else{
            return response()->json([
                'title' => 'Failed',
                'text' => 'Course failed to delete',
                'icon' => 'error'
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
