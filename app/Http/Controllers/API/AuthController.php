<?php

namespace App\Http\Controllers\API;

use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request){

        $cred = $validatedData = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);
     
        if( !auth()->attempt($cred)){
            return response(['message'=>'Invalid credentials']);
        }

        $user = auth()->user();
        $userRole = $user->roles()->first();

        $token = $user->createToken($user->email.'-'.now(), [$userRole->role])->accessToken;

        return response()->json([
            'token' => $token,
            'user' => $user,
            '$userRole' => $userRole
        ]);
     }

     public function logout(Request $request){
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }

}
