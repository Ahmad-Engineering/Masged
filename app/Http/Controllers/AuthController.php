<?php

namespace App\Http\Controllers;

use App\Models\Masged;
use Dotenv\Validator;
use Illuminate\Auth\Access\Response as AccessResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
// use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    //
    public function showLogin (Request $request, $guard) 
    {
        return response()->view('admin.login', ['guard' => $guard]);
    }

    public function login (Request $request) {


        $validator = Validator($request->all(), [
            'email' => 'required|email|min:3|max:30',
            'password' => 'required|string|min:3|max:30',
            'guard' => 'required|string|in:manager,student,teacher'
        ],[
            'guard.in' => 'Wrong URL'
        ]);

        if (!$validator->fails()) {
            $arra = [
                'email' => $request->get('email'),
                'password' => $request->get('password'),
            ];

            if (Auth::guard($request->get('guard'))->attempt($arra, false)) {
                return response()->json([
                    'message' => 'Login successful',
                ], Response::HTTP_OK);
            }else {
                return response()->json([
                    'message' => 'Failed login',
                ], Response::HTTP_BAD_REQUEST);
            }
        }else{
            return response()->json([
                'message' => $validator->getMessageBag()->first(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function editPassword ()  {
        return response()->view('admin.auth.change-password');
    }

    public function updatePassword (Request $request) {
        $guard = auth('manager')->check() ? 'manager' : 'user';

        $validator = Validator($request->all(), [
            'current_password' => "required|string|password:$guard",
            'new_password' => 'required|string|min:8|max:30|confirmed'
        ]);

        if (!$validator->fails()) {

            $user = auth($guard)->user();

            $user->password = Hash::make($request->get('new_password'));
            $isUpdated = $user->save();

            return response()->json([
                'message' => $isUpdated ? 'Password updated successfully' : 'Failed to update password',
            ], $isUpdated ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);

        }else {
            return response()->json([
                'message' => $validator->getMessageBag()->first(),
            ], Response::HTTP_BAD_GATEWAY);
        }
    }

    public function logout (Request $request) {

        if (auth('manager')->check()) {
            auth('manager')->logout();
            $request->session()->invalidate();
            return redirect()->route('login', 'manager');
        }else if (auth('student')->check()) {
            auth('student')->logout();
            $request->session()->invalidate();
            return redirect()->route('login', 'student');
        }else {
            auth('teacher')->logout();
            $request->session()->invalidate();
            return redirect()->route('login', 'teacher');
        }
    }
}
