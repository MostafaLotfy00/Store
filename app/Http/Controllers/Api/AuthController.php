<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        $user= User::where('email', $request->post('email'))->first();

        if($user && Hash::check($request->post('password'),$user->password)){
            $token= $user->createToken('authToken')->plainTextToken;
            return response()->json([
                'message'=>'Success',
                 'token'=>$token,
                 'user'=>$user
                ], 201);
        }
        
        return response()->json([
            'message' => 'Invalid Email or Password',
        ], 401);
    }

    public function logout(){
        request()->user()->currentAccessToken()->delete();
        return response()->json([
            'message' => 'Logged out successfully',
        ], 200);
    }
}
