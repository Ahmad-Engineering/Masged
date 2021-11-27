<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Dotenv\Validator;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
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
        $data = Teacher::all();
        return response()->view('admin.teacher.index', ['teachers'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        // return response()->view('admin.teacher.create');
        // echo 'WE ARE IN THE :: CREATE';
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
            'email' => 'required|string|min:3|max:30',
            'phone' => 'required|string|min:8|max:20',
            'age' => 'required|integer|min:17|max:80',
            'active' => 'required|boolean'
        ]);
        //

        if (!$validator->fails()) {
            $teacher = new Teacher();
            $teacher->first_name = $request->get('first_name');
            $teacher->last_name = $request->get('last_name');
            $teacher->email = $request->get('email');
            $teacher->phone = $request->get('phone');
            $teacher->age = $request->get('age');
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
        //
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
