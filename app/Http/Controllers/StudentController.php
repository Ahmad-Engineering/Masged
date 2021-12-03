<?php

namespace App\Http\Controllers;

use App\Models\Masged;
use App\Models\Student;
use Dotenv\Validator;
use GrahamCampbell\ResultType\Result;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // echo 'WE ARE IN THE :: INDEX';
        $data = Student::all();
        // $masgedData = Masged::all();
        return response()->view('admin.student.index', [
            'students'=>$data
            // 'masgeds' => $masgedData
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        $validator = Validator($request->all(), [
            'first_name' => 'required|string|min:3|max:30',
            'last_name' => 'required|string|min:3|max:30',
            'email' => 'string|min:10|max:50|unique',
            'phone' => 'integer|unique',
            'phone_number' => 'required|integer|unique',
            'age' => 'integer|min:5|max:60',
            'gender' => 'required|string',
            'active' => 'required|boolean'
        ]);
        //
        if (!$validator->fails()) {
            $student = new Student();
            $student->first_name = $request->get('first_name');
            $student->last_name = $request->get('last_name');
            $student->email = $request->get('email');
            $student->phone = $request->get('phone');
            $student->parent_phone = $request->get('parent_phone');
            $student->age = $request->get('age');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
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
}
