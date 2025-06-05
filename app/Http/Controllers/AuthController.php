<?php

namespace App\Http\Controllers;

use app\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // public function register(Request $request){
    //     $fields = $request->validate([
    //         'fullname' => 'required|string',
    //         'firstname' => 'required|string',
    //         'lastname' => 'required|string',
    //         'email' => 'required|string|unique:users,email',
    //         'password' => 'required|string|confirmed'
    //     ]);

    //     $user = User::create([
    //         'fullname' => $fields['fullname'],
    //         'firstname' => $fields['firstname'],
    //         'lastname' => $fields['lastname'],
    //         'email' => $fields['email'],
    //         'password' => bcrypt($fields['password'])
    //     ]);

    //     $token = $user->createToken('myapptoken')->plainTextToken;

    //     $response = [
    //         'user' => $user,
    //         'token' => $token
    //     ];

    //     return response($response, 201);
    // }

    public function register(Request $request)
    {
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'phone' => 'required',
        ]);

        $user = New user();
        $user->fullname = $request->firstname . ' ' . $request->lastname;
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = bcrypt($request->password);

        $user->role_id = 2;
        
        if($user->phone){
            $user->phone = $request->phone;
        }

        if($request->hasFile('profile_photo_path')) {
            $picture = Str::random(25) . '.' . $request->profile_photo_path->getClientOriginalExtension();
            $request->profile_photo_path->storeAs('public/profile-photos', $picture);
            $user->profile_photo_path = $picture; // Asigna la foto al usuario
        }        
        else{
            $user->profile_photo_path = 'default.png';
        }
        
        $token = $user->createToken('myapptoken')->plainTextToken;

        $user->save();

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);
        
        $user = where('username', $request->username)
            ->orWhere('email', $request->email)
            ->first();

        if(!$user || !Hash::check($request->password, $user->password)){
            return response([
                'message' => 'Bad credentials'
            ], 401);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function loguot(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out']);
    }
}
