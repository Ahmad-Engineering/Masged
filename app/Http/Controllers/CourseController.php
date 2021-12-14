<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Masged;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\TeacherCourse;
use Dotenv\Validator;
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
        $count = Masged::where('manager_id', auth()->user()->id)->count();
        if ($count == 0)
            return redirect()->route('admin.parent');

        $masged = Masged::where('manager_id', auth()->user()->id)->first();
        $data = Course::where('masged_name', $masged->name)->get();
        return response()->view('admin.course.index', ['courses' => $data]);
    }

    public function showAddCourse (Course $course) {
        $count = Masged::where('manager_id', auth()->user()->id)->count();
        if ($count == 0)
            return redirect()->route('admin.parent');

        $masged = Masged::where('manager_id', auth()->user()->id)->first();
        $courses = Course::where('masged_name', $masged->name)->get();
        $teachers = Teacher::where('masged_id', $masged->id)->get();
        // $courseId = $course->id;
        // $teacher = Teacher::where('masged_id', $masged->id)->get();
        // foreach ($teacher as $reTeacher) {
        //     $teacherId = $reTeacher->id;
        // }
        // $teachers = Teacher::with(['courses' =>function ($query) use($courseId, $teacherId) {
        //     $query->where('course_id', '!=', $courseId)
        //     ->where('teacher_id', '!=',$teacherId)
        //     ->get();
        // }])
        // ->where('masged_id', $masged->id)
        // ->get();

        foreach ($courses as $reCourse) {
            if ($course->id == $reCourse->id) {
                $course = Course::where('id', $course->id)->get();
                return response()->view('admin.course.addCourse', ['course' => $course, 'teachers' => $teachers]);
            }
        }
        return redirect()->route('course.index');

    }

    public function addCourse (Request $request, Course $course, Teacher $teacher) {
        // IS THERE AN MASGED ?
        $count = Masged::where('manager_id', auth()->user()->id)->count();
        if ($count == 0)
            return redirect()->route('admin.parent');

        if ($course->status && $teacher->active) {

            $count = TeacherCourse::where('teacher_id', $teacher->id)
            ->where('course_id', $course->id)
            ->count();
    
            if ($count == 0) {
                $teacherCourse = new TeacherCourse();
                $teacherCourse->course_id = $course->id;
                $teacherCourse->course_name = $course->name;
                $teacherCourse->teacher_id = $teacher->id;
        
                $isCreated = $teacherCourse->save();
        
                if ($isCreated) {
                    return response()->json([
                        'icon' => 'success',
                        'title' => 'Added',
                        'text' => 'The ' . $course->name . ' added for ' . $teacher->first_name . ' ' . $teacher->last_name . ' successfully',
                    ], Response::HTTP_OK);
                }else {
                    return response()->json([
                        'icon' => 'error',
                        'title' => 'Failed',
                        'text' => 'Failed to add course for the teacher.',
                    ], Response::HTTP_BAD_REQUEST);
                }
            }else {
                return response()->json([
                    'icon' => 'error',
                    'title' => 'Failed',
                    'text' => $teacher->first_name . ' ' . $teacher->last_name . ' taken this course before ' . $course->name . '.',
                ], Response::HTTP_BAD_REQUEST);
            }
        }else {
            return response()->json([
                'icon' => 'error',
                'title' => 'Failed',
                'text' => $course->name . ' or ' . $teacher->first_name . ' ' . $teacher->last_name .' is disabled, active it and try agian.',
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // IS THERE AN MASGED ?
        $count = Masged::where('manager_id', auth()->user()->id)->count();
        if ($count == 0)
            return redirect()->route('admin.parent');
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
        // IS THERE AN MASGED ?
        $count = Masged::where('manager_id', auth()->user()->id)->count();
        if ($count == 0)
            return redirect()->route('admin.parent');


        $validator = Validator($request->all(), [
            'name' => 'required|string|min:3|max:40|unique:courses',
            'info' => 'string|max:100',
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
                'message' => $validator->getMessageBag()->first()
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

        // IS THERE AN MASGED ?
        $count = Masged::where('manager_id', auth()->user()->id)->count();
        if ($count == 0)
            return redirect()->route('admin.parent');

        //
        $masged  = Masged::where('manager_id', auth()->user()->id)->first();

        $count = Course::where('masged_name', $masged->name)
        ->where('id', $course->id)
        ->count();

        if ($count == 0)
            return redirect()->view('admin.student.show-courses');

        $course_id = $course->id;

        $students = Student::where('masged_name', $masged->name)
        ->with(['courses' => function ($query) use($course_id) {
            $query->where('course_id', $course_id);
        }])
        ->get();

        return response()->view('admin.student.student-course', ['students' => $students]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {

        // IS THERE AN MASGED ?
        $count = Masged::where('manager_id', auth()->user()->id)->count();
        if ($count == 0)
            return redirect()->route('admin.parent');

        //
        $masged = Masged::where('manager_id', auth()->user()->id)->first();
        $course_collection = Course::where('masged_name', $masged->name)->get();

        foreach ($course_collection as $reCourse) {
            if ($reCourse->id == $course->id) {
                return response()->view('admin.course.edit', ['course' => $course]);
            }
        }
        return redirect()->route('course.index');
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

        // IS THERE AN MASGED ?
        $count = Masged::where('manager_id', auth()->user()->id)->count();
        if ($count == 0)
            return redirect()->route('admin.parent');

        $validator = Validator($request->all(), [
            'name' => 'required|string|min:3|max:40',
            'info' => 'string|min:1|max:100',
            'status' => 'required|boolean'
        ]);
        //

        if (!$validator->fails()) {
            $masged = Masged::where('manager_id', auth()->user()->id)->first();

            $course->name = $request->get('name');
            $course->info = $request->get('info');
            $course->status = $request->get('status');
            $course->masged_name = $masged->name;

            $isUpdated = $course->save();
            
            return response()->json([
                'message' => $isUpdated ? 'Course updated successfully' : 'Failed to update course' 
            ], $isUpdated ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
        }else {
            return response()->json([
                'message' => $validator->getMessageBag()->first(),
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
        // IS THERE AN MASGED ?
        $count = Masged::where('manager_id', auth()->user()->id)->count();
        if ($count == 0)
            return redirect()->route('admin.parent');
            
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
