<?php

namespace App\Http\Controllers;

use App\Models\Masged;
use Dotenv\Validator;
use GrahamCampbell\ResultType\Result;
use GuzzleHttp\RetryMiddleware;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

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
        $data = Masged::where('manager_id', auth()->user()->id)->get();
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
        return response()->view('admin.masged.create');
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
            'name'=>'required|min:3|max:30',
            'info'=>'min:0|max:100',
            'location'=>'required|min:3|max:100'
        ]);
        $count = Masged::Where('manager_id', auth()->user()->id)->count();
        if ($count != 0) {
            return response()->json([
                'message' => 'You can not manage more than one masged'
            ], Response::HTTP_BAD_REQUEST);
        }
        //
        if (!$validator->fails()) {
            // dd($request->all());
            $masged = new Masged();
            $masged->name = $request->get('name');
            $masged->info = $request->get('info');
            $masged->location = $request->get('location');
            $masged->manager_id = auth()->user()->id;
            $isCreated = $masged->save();

            return response()->json([
                'message' => $isCreated ? 'Mosque created successfully' : 'Mosque created failed'
            ], $isCreated ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
        }else{
            return response()->json([
                'message'=> $validator->getMessageBag()->first()
            ], Response::HTTP_BAD_REQUEST);
        }
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
        $data = Masged::where('manager_id', auth()->user()->id)->first();
        if ($masged->id == $data->id) {
            return response()->view('admin.masged.edit', ['masged'=>$masged]);
        }else{
            return redirect()->route('masged.index');
        }
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
        $validator = Validator($request->all(), [
            'name'=>'required|min:3|max:30',
            'info'=>'min:0|max:100',
            'location'=>'required|min:3|max:30'
        ]);
        //

        if (!$validator->fails()) {
            $masged->name = $request->get('name');
            $masged->info = $request->get('info');
            $masged->location = $request->get('location');
            $isUpdated = $masged->save();

            return response()->json([
                'message' => $isUpdated ? 'Masged updated successfully' : 'Masged updated failed'
            ], $isUpdated ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
        }else{
            return response()->json([
                'message' => $validator->getMessageBag()->first()
            ], Response::HTTP_BAD_REQUEST);
        }
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
        $isDeleted = $masged->delete();

        if ($isDeleted) {
            return response()->json([
                'title' => 'Deleted!',
                'text' => 'Deleted mosque successfully',
                'icon' => 'success',
            ]);
        }else {
            return response()->json([
                'title' => 'Failed!',
                'text' => 'Deleted mosque failed',
                'icon' => 'error',
            ]);
        }
    }
}
