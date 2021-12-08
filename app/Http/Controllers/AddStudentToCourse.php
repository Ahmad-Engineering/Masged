<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Masged;
use App\Models\Student;
use App\Models\StudentCourse;
use App\Models\StudentTeacher;
use App\Models\TeacherCourse;
use Illuminate\Http\Request;

class AddStudentToCourse extends Controller
{
    //
    public function showAddingStudent (Course $course) {
        $masged = Masged::where('manager_id', auth()->user()->id)->first();
        $students = Student::where('masged_name', $masged->name)->get();
        return response()->view('admin.course.addStudentToCourse', ['course' => $course, 'students' => $students]);
    }

    public function addStudent (Course $course, Student $student) {
        $count = StudentCourse::where('student_id', $student->id)
        ->where('course_id', $course->id)
        ->count();

        if ($count == 0) {

            $teacher = TeacherCourse::where('course_id', $course->id)->first();
            $teacherCount = TeacherCourse::where('course_id', $course->id)
            ->count();

            if ($teacherCount != 0) {

                $studentCourse = new StudentCourse();
                $studentCourse->student_id = $student->id;
                $studentCourse->course_id = $course->id;
                $isCreated = $studentCourse->save();
    
                if ($isCreated) {

                    $studentTeacher = new StudentTeacher();
                    $studentTeacher->student_id = $student->id;
                    $studentTeacher->teacher_id = $teacher->id;
                    $isCreated = $studentTeacher->save();

                    if ($isCreated) {
                        return response()->json([
                            'icon' => 'success',
                            'title' => 'Success!',
                            'text' => $student->first_name . ' ' . $student->last_name . ' added to ' . $course->name . ' successfully',
                        ]);
                    }else {
                        return response()->json([
                            'icon' => 'error',
                            'title' => 'Failed!',
                            'text' => 'Failed to add ' . $student->first_name . ' ' . $student->last_name . ' to ' . $teacher->first_name . ' ' . $teacher->last_name . ' in ' . $course->name . ' course.',
                        ]);
                    }

                }else {
                    return response()->json([
                        'icon' => 'error',
                        'title' => 'Failed!',
                        'text' => 'Failed to add ' . $student->first_name . ' ' . $student->last_name . ' to ' . $course->name,
                    ]);
                }
            }else {
                return response()->json([
                    'icon' => 'error',
                    'title' => 'Failed!',
                    'text' => 'The ' . $course->name . ' dose not taken from another teacher, add it to teacher and try agian.',
                ]);
            }

        }else {
            return response()->json([
                'icon' => 'error',
                'title' => 'Failed!',
                'text' => $student->first_name . ' ' . $student->last_name . ' is really added to ' . $course->name . ' before.',
            ]);
        }
    }
}
