<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserApiController extends Controller
{
    public function register (Request $request){
        $request->validate([
            'nom' => 'required|max:255',
            'prenom' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'tel' => 'numeric',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'nom' => $request['first_name'],
            'prenom' => $request['last_name'],
            'email' => $request['email'],
            'tel' => $request['tele'],
            'role' => 'user',
            'password' => bcrypt($request['password'])
        ]);

        $token = JWTAuth::fromUser($user);

        return response()->json([
            "message" => "User regitred successfully !",
            'user' => $user,
            'token' => $token
        ]) ;
    }

    public function login (Request $request){
        $request->validate([
            'email' => 'required|email',
            'password'=> 'required|min:6'
        ]);

        if (!$token = JWTAuth::attempt($request->only('email', 'password'))) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $user = Auth::user();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            "message" => 'logged in successfully',
            "token" => $token,
            "user" => $user
        ]);
    }
    
    public function logout()
    {
        JWTAuth::invalidate(JWTAuth::getToken());

        return response()->json(['message' => "Logged out seccessfully !"]);
    }
}