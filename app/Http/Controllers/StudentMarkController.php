<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Mark;
use App\Models\Masged;
use App\Models\Student;
use App\Models\StudentCourse;
use Dotenv\Validator;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Match_;
use Symfony\Component\HttpFoundation\Response;


class StudentMarkController extends Controller
{
    //

    public function showStudentPage ($id) {
        // IS THERE AN MASGED ?
        $count = Masged::where('manager_id', auth()->user()->id)->count();
        if ($count == 0)
            return redirect()->route('admin.parent');

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
        // IS THERE AN MASGED ?
        $count = Masged::where('manager_id', auth()->user()->id)->count();
        if ($count == 0)
            return redirect()->route('admin.parent');


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

    public function submitMark (Request $request, Mark $mark) {
        // IS THERE AN MASGED ?
        $count = Masged::where('manager_id', auth()->user()->id)->count();
        if ($count == 0)
            return redirect()->route('admin.parent');


        $validator = Validator($request->all(), [
            'mark' => 'required|numeric|between:0,100.00'
        ]);

        if (!$validator->fails()) {
            

            $masged = Masged::where('manager_id', auth()->user()->id)->first();
            $count = Course::where('id', $request->course_id)
            ->where('masged_name', $masged->name)
            ->count();
            $student = Student::where('id', $request->student_id)->first();
    
            if ($count == 0)
                return redirect()->route('admin.parent');

            $count = Mark::where('course_id', $request->course_id)
            ->where('student_id', $request->student_id)
            ->count();
    
            if ($count == 0) {

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
                    'message' => $isCreated ? 'Mark ' . $request ->mark . ' saved successfully for ' . $student->first_name . ' ' . $student->last_name : 'Failed to save the message'
                ], $isCreated ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
                
            }else {
                $mark = Mark::where('course_id', $request->course_id)
                ->where('student_id', $request->student_id)
                ->first();

                $mark->marks = $request->mark;
                $isSaved = $mark->save();


                if ($isSaved) {
                    return response()->json([
                        'message' => 'You are add a the new mark ' . $mark->marks . ' for '. $student->first_name . ' ' . $student->last_name . ' student.'
                    ], Response::HTTP_OK);
                }else {
                    return response()->json([
                        'message' => 'Failed to save the new mark.'
                    ], Response::HTTP_BAD_REQUEST);
                }
            }
            

        }else {
            return response()->json([
                'message' => $validator->getMessageBag()->first()
            ], Response::HTTP_BAD_REQUEST);
        }

    }
}
