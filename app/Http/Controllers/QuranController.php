<?php

namespace App\Http\Controllers;

use App\Models\Circle;
use App\Models\Masged;
use App\Models\Quran;
use App\Models\Student;
use Illuminate\Http\Request;

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
        dd($students);
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
