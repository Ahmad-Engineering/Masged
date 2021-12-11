<?php

namespace App\Http\Controllers;

use App\Models\Masged;
use App\Models\Teacher;
use Dotenv\Validator;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // return view('admin.teacher.index');
        $masged = Masged::where('manager_id', auth()->user()->id)->first();
        $count = Teacher::where('masged_id', $masged->id)->count();
        if ($count == 0) {
            return redirect()->route('admin.parent');
        }else {
            // $masged = Masged::where('manager_id', auth()->user()->id)->first();
            $data = Teacher::Where('masged_id', $masged->id)->get();
            return response()->view('admin.teacher.index', ['teachers'=>$data]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return response()->view('admin.teacher.create');
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
            'phone' => 'required|string|min:8|max:20|unique:teachers',
            'email' => 'required|string|min:3|max:30|unique:teachers',
            'age' => 'required|integer|min:17|max:80',
            'active' => 'required|boolean'
        ]);
        //

        if (!$validator->fails()) {
            $masge = Masged::where('manager_id', auth()->user()->id)->first();
            $teacher = new Teacher();
            $teacher->first_name = $request->get('first_name');
            $teacher->last_name = $request->get('last_name');
            $teacher->email = $request->get('email');
            $teacher->phone = $request->get('phone');
            $teacher->age = $request->get('age');
            $teacher->password = Hash::make('password');
            $teacher->masged_id = $masge->id;
            $teacher->active = $request->get('active');
            // WE WILL UPDATE IT AGIAN
            $teacher->gender = 1;

            $isCreated = $teacher->save();

            return response()->json([
                'message'=> $isCreated ? 'Teacher craeting successfully' : 'Teacher craeting failed'
            ], $isCreated ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
        }else {
            return response()->json([
                'message'=>$validator->getMessageBag()->first()
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function show(Teacher $teacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function edit(Teacher $teacher)
    {
        //
        // $masged = Masged::where('manager_id', auth()->user()->id)->first();
        // $reTeacher = Teacher::all();

        $masge = Masged::where('manager_id', auth()->user()->id)->first();
        $teacher_collection = Teacher::where('masged_id', $masge->id)->get();
        foreach ($teacher_collection as $reTeacher) {
            if ($teacher->id == $reTeacher->id) {
                return response()->view('admin.teacher.edit', ['teacher'=>$teacher]);
            }
        }
        return redirect()->route('teacher.index');

        // foreach ($reTeacher as $oneTeacher) {
        //     dd($oneTeacher->id );
        //     if ($oneTeacher->id == $teacher->id) {
        //         return response()->view('admin.teacher.edit', ['teacher'=>$teacher]);
        //     }else{
        //         return redirect()->route('teacher.index');
        //     }
        // }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Teacher $teacher)
    {
        $validator = Validator($request->all(), [
            'first_name' => 'required|string|min:3|max:30',
            'last_name' => 'required|string|min:3|max:30',
            'email' => 'required|string|min:3|max:45',
            'phone' => 'required|string|min:8|max:20',
            'age' => 'required|integer|min:17|max:80',
            'active' => 'required|boolean'
        ],[
            'phone.required' => 'Re-enter a new phone, this phone has been used'
        ]);
        //
        if (!$validator->fails()) {
            $teacher->first_name = $request->get('first_name');
            $teacher->last_name = $request->get('last_name');
            $teacher->email = $request->get('email');
            $teacher->phone = $request->get('phone');
            $teacher->age = $request->get('age');
            $teacher->active = $request->get('active');

            $isUpdated = $teacher->save();

            return response()->json([
                'message' => $isUpdated ? 'Teacher updated successfully' : 'Updating teacher faild',
            ], $isUpdated ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);

        }else{
            return response()->json([
                'message' => $validator->getMessageBag()->first()
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function showTeacherCourses () {

        $masged = Masged::where('manager_id', auth()->user()->id)->first();
        $teacher_courses = Teacher::where('masged_id', $masged->id)
        ->with(['courses'])
        ->get();

        return response()->view('admin.teacher.teacher-courses', ['teacher_courses' => $teacher_courses]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teacher $teacher)
    {
        //
        $isDeleted = $teacher->delete();

        if ($isDeleted) {
            return response()->json([
                'title'=>'Deleted!',
                'text'=>'Teacher deleted successfully',
                'icon'=>'success'
            ]);
        }else {
            return response()->json([
                'title'=>'Failed!',
                'text'=>'Teacher deleted failed',
                'icon'=>'error'
            ]);
        }
    }
}
