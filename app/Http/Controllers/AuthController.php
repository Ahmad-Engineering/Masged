<?php

namespace App\Http\Controllers;

use Dotenv\Validator;
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
        // $guard = auth('manager')->check() ? 'manager' : 'user';

        if (auth('manager')->check()) {
            $guard = 'manager';
        }else if (auth('teacher')->check()) {
            $guard = 'teacher';
        }else {
            $guard = 'student';
        }

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
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function editProfile () {
        if (auth('manager')->check()) {
            $user = auth('manager')->user();
            $guard = 'manager';
        }

        return response()->view('admin.auth.edit-admin', ['user' => $user, 'guard' => $guard]);
        
    }

    public function updateAdminProfile (Request $request) {

        if ($request->email == auth('manager')->user()->email) {
            $validator = Validator($request->all(), [
                'first_name' => 'required|string|min:3|max:30',
                'last_name' => 'required|string|min:3|max:30',
                'age' => 'required|integer|min:17|max:80',
                'phone' => 'required|string',
                'email' => 'required|string|min:3|max:45'
            ]);
        }else {
            $validator = Validator($request->all(), [
                'first_name' => 'required|string|min:3|max:30',
                'last_name' => 'required|string|min:3|max:30',
                'age' => 'required|integer|min:17|max:80',
                'phone' => 'required|string',
                'email' => 'required|string|min:3|max:45|unique:managers,email'
            ]);
    
        }

        if (!$validator->fails()) {

            $user = auth('manager')->user();

            $user->first_name = $request->get('first_name');
            $user->last_name = $request->get('last_name');
            $user->age = $request->get('age');
            $user->phone = $request->get('phone');
            $user->email = $request->get('email');

            $isUpdated = $user->save();

            return response()->json([
                'message' => $isUpdated ? 'Account updated successfully' : 'Failed to update account info',
            ], $isUpdated ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);

        }else {
            return response()->json([
                'message' => $validator->getMessageBag()->first(),
            ], Response::HTTP_BAD_REQUEST);
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
