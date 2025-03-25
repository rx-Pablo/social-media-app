<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {   
        $users = User::all();

        return response()->json([
            'users' => $users,
        ]);
    }

    public function show($id)
    {   
        $user = User::where('id', $id)
            ->first();

        return response()->json([
            'user' => $user,
        ]);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        if($request->hasFile('profile_photo_path')) {
            $picture = Str::random(25) . '.' . $request->profile_photo_path->getClientOriginalExtension();
            $request->profile_photo_path->storeAs('public/profile-photos', $picture);
            $user->profile_photo_path = $picture;
        }            

        $data = $request->only(['phone', 'email', 'username', 'fullname', 'firstname', 'lastname']);

        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }
        $user->update($data);

        return response()->json(['message' => 'Updated User Successfully!']);
    }

    public function destroy($id)
    {
        $user = User::where('id', $id)
            ->first();
        if($user){
            $user->delete();
        }

        return response()->json(['message' => 'User Deleted Successfully!']);
    }
}
