<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Masged;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // IS THERE AN MASGED ?
        $count = Masged::where('manager_id', auth()->user()->id)->count();
        if ($count == 0)
            return redirect()->route('admin.parent');

        //
        // echo 'WE ARE IN THE :: INDEX';
        $count = Masged::where('manager_id', auth()->user()->id)->count();
        if ($count == 0) {
            return redirect()->route('admin.parent');
        }else {
            $masged = Masged::where('manager_id', auth()->user()->id)->first();
            $data = Student::where('masged_name', $masged->name)->get();
            // $masgedData = Masged::all();
            return response()->view('admin.student.index', [
                'students'=>$data
                // 'masgeds' => $masgedData
            ]);
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
        // echo 'WE ARE IN THE :: CREATE';
        return response()->view('admin.student.create');
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
            'first_name' => 'required|string|min:3|max:30',
            'last_name' => 'required|string|min:3|max:30',
            'email' => 'string|min:10|max:50|unique:students',
            'phone' => 'string|unique:students',
            'parent_phone' => 'string|string',
            'age' => 'integer|min:5|max:60',
            'gender' => 'required|string',
            'active' => 'required|boolean'
        ]);
        //
        if (!$validator->fails()) {
            $masged = Masged::where('manager_id', auth()->user()->id)->first();

            $student = new Student();
            $student->first_name = $request->get('first_name');
            $student->last_name = $request->get('last_name');
            $student->email = $request->get('email');
            $student->phone = $request->get('phone');
            $student->parent_phone = $request->get('parent_phone');
            $student->age = $request->get('age');
            $student->password = Hash::make('password');
            // MASGED NAME WE WILL UPDATE IT LATER
            $student->masged_name = $masged->name;
            if ($request->get('gender') == 'male') {
                $student->gender = 'Male';
            }else{
                $student->gender = 'Female';
            }
            $student->status = $request->get('active');

            $isCreated = $student->save();

            return response()->json([
                'message' => $isCreated ? 'Student created successfully' : 'Failed to create student',
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
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        // IS THERE AN MASGED ?
        $count = Masged::where('manager_id', auth()->user()->id)->count();
        if ($count == 0)
            return redirect()->route('admin.parent');

        //
        $masged = Masged::where('manager_id', auth()->user()->id)->first();
        $student_collection = Student::where('masged_name', $masged->name)->get();

        foreach ($student_collection as $reStudent) {
            if ($reStudent->id == $student->id) {
                return response()->view('admin.student.edit', ['student'=>$student]);
            }
        }
        return redirect()->route('student.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        // IS THERE AN MASGED ?
        $count = Masged::where('manager_id', auth()->user()->id)->count();
        if ($count == 0)
            return redirect()->route('admin.parent');

        $validator = Validator($request->all(), [
            'first_name' => 'required|string|min:3|max:30',
            'last_name' => 'required|string|min:3|max:30',
            'email' => 'string|min:10|max:50',
            'phone' => 'string',
            'parent_phone' => 'required|string',
            'age' => 'integer|min:5|max:60',
            'gender' => 'required|string',
            'active' => 'required|boolean'
        ]);
        //
        if (!$validator->fails()) {
            $masged = Masged::where('manager_id', auth()->user()->id)->first();

            $student->first_name = $request->get('first_name');
            $student->last_name = $request->get('last_name');
            $student->email = $request->get('email');
            $student->phone = $request->get('phone');
            $student->parent_phone = $request->get('parent_phone');
            $student->age = $request->get('age');
            // MASGED NAME WE WILL UPDATE IT LATER
            $student->masged_name = $masged->name;
            if ($request->get('gender') == 'male') {
                $student->gender = 'Male';
            }else{
                $student->gender = 'Female';
            }
            $student->status = $request->get('active');

            $isUpdated = $student->save();

            return response()->json([
                'message' => $isUpdated ? 'Student updated successfully' : 'Failed to update student',
            ]);
        }else {
            return response()->json([
                'message' => $validator->getMessageBag()->first(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function showStudentCourses () {
        // IS THERE AN MASGED ?
        $count = Masged::where('manager_id', auth()->user()->id)->count();
        if ($count == 0)
            return redirect()->route('admin.parent');

        $masged = Masged::where('manager_id', auth()->user()->id)->first();
        // $student_with_courses = Student::where('masged_name', $masged->name)
        // ->with('courses')
        // ->get();
        $courses = Course::where('masged_name', $masged->name)->get();
        return response()->view('admin.student.show-courses', ['courses' => $courses]);
    }

    // public function showStudent (Request $request, Course $course) {
    //     dd($course->id);
    // }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        // IS THERE AN MASGED ?
        $count = Masged::where('manager_id', auth()->user()->id)->count();
        if ($count == 0)
            return redirect()->route('admin.parent');
            
        //
        $isDeleted = $student->delete();

        if ($isDeleted) {
            return response()->json([
                'title' => 'Deleted!',
                'text' => 'Student deleted successfully',
                'icon' => 'success',
            ]);
        }else{
            return response()->json([
                'title' => 'Failed!',
                'text' => 'Student deleted failed',
                'icon' => 'error',
            ]);
        }

    }

    public function userNumbers (Request $request) {
        // GET NUMBERS OF ALL USERS IN THE SYSTEM

        $count = Masged::where('manager_id', auth()->user()->id)->count();
        if ($count == 0){
            $request->session()->put('student_no', 0);
            $request->session()->put('course_no', 0);
            $request->session()->put('teacher_no', 0);
            $request->session()->put('masged_no', 0);
    
            return response()->view('admin.parent');
        } else {
            $masged = Masged::where('manager_id', auth()->user()->id)->first();
            $student_no = Student::where('masged_name', $masged->name)->count();
            $course_no = Course::where('masged_name', $masged->name)->count();
            $teacher_no = Teacher::where('masged_id', $masged->id)->count();
            $masged_no = Masged::where('manager_id', auth()->user()->id)->count();
    
            // $this->Session::set('student_no', $student_no);
            // $this->Session::set('teacher_no', $teacher_no);
            // $this->Session::set('masged_no', $masged_no);
            // $this->Session::set('course_no', $course_no);
    
            $request->session()->put('student_no', $student_no);
            $request->session()->put('course_no', $course_no);
            $request->session()->put('teacher_no', $teacher_no);
            $request->session()->put('masged_no', $masged_no);
    
            return response()->view('admin.parent');
        }
    }
}
