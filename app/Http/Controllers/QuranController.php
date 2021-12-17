<?php

namespace App\Http\Controllers;

use App\Models\Circle;
use App\Models\Masged;
use App\Models\Quran;
use App\Models\Student;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class QuranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $count = Masged::where('manager_id', auth()->user()->id)->count();
        if ($count == 0)
            return redirect()->route('admin.parent');
        //
        $masged = Masged::where('manager_id', auth()->user()->id)->first();
        $circles = Circle::where('masged_id', $masged->id)->get();

        return response()->view('admin.quran.show-circles', [
            'circles' => $circles
        ]);
    }

    public function getCircle ($circleId) {
        $count = Masged::where('manager_id', auth()->user()->id)
        ->count();
        if ($count == 0)
            return redirect()->route('admin.parent');
        
        $masged = Masged::where('manager_id', auth()->user()->id)
        ->first();
        $count = Circle::where('masged_id', $masged->id)
        ->where('id', $circleId)
        ->count();
        if ($count == 0)
            return redirect()->route('admin.parent');

        $students = Student::where('circle_id', $circleId)->get();
        return response()->view('admin.quran.student-circle', [
            'students' => $students,
            'circleId' => $circleId
        ]);
    }

    public function returnStuedntDetaislWithCircle ($circleId, $studentId) {
        $count = Masged::where('manager_id', auth()->user()->id)
        ->count();
        if ($count == 0)
            return redirect()->route('admin.parent');
        
        $masged = Masged::where('manager_id', auth()->user()->id)->first();
        
        $count = Student::where('id', $studentId)
        ->where('masged_name', $masged->name)
        ->count();
        if ($count == 0) 
            return redirect()->route('admin.parent');
        
        $student = Student::where('id', $studentId)
        ->where('masged_name', $masged->name)
        ->first();

        $count = Circle::where('id', $circleId)
        ->where('masged_id', $masged->id)
        ->count();
        if ($count == 0) 
            return redirect()->route('admin.parent');
        
        $circle = Circle::where('id', $circleId)
        ->where('masged_id', $masged->id)
        ->first();

        return response()->view('admin.quran.create', [
            'student' => $student,
            'circle' => $circle,
        ]);
    }

    public function addQuran (Request $request) {

        $validator = Validator($request->all(), [
            'part_no' => 'required|integer|min:1|max:30',
            'from_page' => 'required|integer|min:1|max:604',
            'to_page' => 'required|integer|min:1|max:604',
        ]);

        if (!$validator->fails()) {
            $quran = new Quran();
            $quran->part_no = $request->part_no;
            $quran->from_page = $request->from_page;
            $quran->to_page = $request->to_page;
            $quran->circle_id = $request->circleId;
            $quran->student_id = $request->studentId;
    
            $isCreated = $quran->save();
    
            if ($isCreated) {
                return response()->json([
                    'message' => 'Added successfully',
                ], Response::HTTP_OK); 

            }else {
                return response()->json([
                    'message' => 'Failed to add the info',
                ], Response::HTTP_BAD_REQUEST); 
            }
        }else {
            return response()->json([
                'message' => $validator->getMessageBag()->first(),
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
     * @param  \App\Models\Quran  $quran
     * @return \Illuminate\Http\Response
     */
    public function show(Quran $quran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Quran  $quran
     * @return \Illuminate\Http\Response
     */
    public function edit(Quran $quran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Quran  $quran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Quran $quran)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Quran  $quran
     * @return \Illuminate\Http\Response
     */
    public function destroy(Quran $quran)
    {
        //
    }
}
