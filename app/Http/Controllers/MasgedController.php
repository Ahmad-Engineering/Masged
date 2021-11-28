<?php

namespace App\Http\Controllers;

use App\Models\Masged;
use Illuminate\Http\Request;

class MasgedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Masged::all();
        return response()->view('admin.masged.index', ['masgeds'=> $data]);
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
     * @param  \App\Models\Masged  $masged
     * @return \Illuminate\Http\Response
     */
    public function show(Masged $masged)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Masged  $masged
     * @return \Illuminate\Http\Response
     */
    public function edit(Masged $masged)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Masged  $masged
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Masged $masged)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Masged  $masged
     * @return \Illuminate\Http\Response
     */
    public function destroy(Masged $masged)
    {
        //
    }
}
