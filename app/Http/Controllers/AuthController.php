<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function register(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required|min:8'
        ]);

        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>$request->password,
        ]);

        $token = $user->createToken('auth-token')->plainTextToken;
            return response()->json([
                'message'=> 'Successful',
                'data'=>$user,
                'token' => $token,
           ],200);
    }

    public function login(Request $request){
        $request ->validate([
            'email'=>'required',
            'password'=>'required'
        ]);

        $credentials = $request->only('email','password');
        $token = Auth::attempt($credentials);

        if(!$token){
            return response()->json([
                'status' =>'error',
                'message'=>'Login Failed'
            ]);
        }

        return response()->json([
            'status'=>'success',
            'messaga'=>'Logged in successfully!',
            'token'=>$token
        ]);
    } 

    

        
}
