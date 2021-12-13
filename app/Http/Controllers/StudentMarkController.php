<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Mark;
use App\Models\Masged;
use App\Models\Student;
use App\Models\StudentCourse;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


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

        return response()->view('admin.student.student-course-mark', ['students' => $students, 'real_id' => $id]);
    }



    public function showMarkPage ($course_id, $student_id) {

        // IS THIS COURSE BELONGS TO THIS MASGED OR NOT ?
        $masged = Masged::where('manager_id', auth()->user()->id)->first();
        $count = Course::where('masged_name', $masged->name)->count();

        if ($count == 0)
            return redirect()->route('admin.parent');

        // IS THERE IS A MARK FOR THIS STUDENT IN THIS COURSE BEFORE OR NOT
        $count = StudentCourse::where('student_id', $student_id)
        ->where('course_id', $course_id)
        ->count();

        if ($count == 0)
            return redirect()->route('admin.parent');

        // ELSE THAT REDIRECT TO PUT THE MARK
        $student = Student::where('id', $student_id)->first();
        $course = Course::where('id', $course_id)->first();
        return response()->view('admin.student.add-mark', ['course' => $course, 'student' => $student]);
    }

    public function submitMark (Request $request) {

        $validator = Validator($request->all(), [
            'mark' => 'required|numeric|between:0,100.00'
        ]);

        if (!$validator->fails()) {
            

            $masged = Masged::where('manager_id', auth()->user()->id)->first();
            $count = Course::where('id', $request->course_id)
            ->where('masged_name', $masged->name)
            ->count();
    
            if ($count == 0)
                return redirect()->route('admin.parent');
            
            $course = Course::where('id', $request->course_id)
            ->where('masged_name', $masged->name)
            ->first();
    
            $mark = new Mark();
            $mark->student_id = $request->student_id;
            $mark->course_id = $request->course_id;
            $mark->course_name = $course->name;
            $mark->marks = $request->mark;

            $isCreated = $mark->save();

            return response()->json([
                'message' => $isCreated ? 'Marks saved successfully' : 'Failed to save the message'
            ], $isCreated ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);

        }else {
            return response()->json([
                'message' => $validator->getMessageBag()->first()
            ], Response::HTTP_BAD_REQUEST);
        }

    }
}
