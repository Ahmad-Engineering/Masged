<?php

namespace App\Http\Controllers;

use App\Models\Circle;
use App\Models\Masged;
use Dotenv\Validator;
use GuzzleHttp\RetryMiddleware;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CircleController extends Controller
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

        return response()->view('admin.circle.index', [
            'circles' => $circles
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $count = Masged::where('manager_id', auth()->user()->id)->count();
        if ($count == 0)
            return redirect()->route('admin.parent');
        //

        return response()->view('admin.circle.create');
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
            'name' => 'required|string|min:3|max:30',
            // 'info' => 'string|min:3|max:30'
        ]);
        //
        if (!$validator->fails()) {
            $masged = Masged::where('manager_id', auth()->user()->id)->first();


            // IF THIS CIRCLE FOR THIS MASGED CREATED BEFORE OF NOT ?
            $count = Circle::where('name', $request->name)
            ->where('masged_id', $masged->id)
            ->count();

            if ($count == 0) {

                // CREATE A NEW CIRCLE IN THIS MASGED
                $circle = new Circle();
                $circle->name = $request->name;
                $circle->info = $request->info;
                $circle->masged_id = $masged->id;

                $isCreated = $circle->save();

                if ($isCreated) {

                    // IS THIS CIRCLE CREATED ?
                    return response()->json([
                        'message' => 'Circle ' . $request->name . ' is created successfully'
                    ], Response::HTTP_OK);

                }else {

                    //  AN ERROR WITH CREATING THIS CIRCLE IN THIS MAGED
                    return response()->json([
                        'message' => 'Failed to create ' . $request->name ,
                    ], Response::HTTP_BAD_REQUEST);

                }

            }else {
                return response()->json([
                    'message' => 'You are created a circle in this name before.'
                ], Response::HTTP_BAD_REQUEST);
            }
            // END IF THIS CIRCLE FOR THIS MASGED CREATED BEFORE OF NOT ?

        }else {
            return response()->json([
                'message' => $validator->getMessageBag()->first()
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Circle  $circle
     * @return \Illuminate\Http\Response
     */
    public function show(Circle $circle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Circle  $circle
     * @return \Illuminate\Http\Response
     */
    public function edit(Circle $circle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Circle  $circle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Circle $circle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Circle  $circle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Circle $circle)
    {
        $count = Masged::where('manager_id', auth()->user()->id)->count();
        if ($count == 0)
            return redirect()->route('admin.parent');

        $isDeleted = $circle->delete();

        if ($isDeleted) {
            return response()->json([
                'icon' => 'success',
                'text' => $circle->name . ' deleted successfully',
                'title' => 'Deleted!',
            ]);
        }else {
            return response()->json([
                'icon' => 'error',
                'text' => $circle->name . ' failed to delete',
                'title' => 'Failed!',
            ]);
        }
        //
    }
}
