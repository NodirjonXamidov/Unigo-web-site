<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // public function register(Request $request){
    //     $request->validate([
    //         'name'=>'required',
    //         'email'=>'required|email',
    //         'password'=>'required|min:8'
    //     ]);

    //     $user = User::create([
    //         'name'=>$request->name,
    //         'email'=>$request->email,
    //         'password'=>$request->password,
    //     ]);

    //     $token = $user->createToken('auth-token')->plainTextToken;
    //         return response()->json([
    //             'message'=> 'Successful',
    //             'data'=>$user,
    //             'token' => $token,
    //        ],200);
    // }


    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'email' =>'required|email',
            'password' =>'required',
            ]);

        if ($validator->fails()) {
            return response()->json([
                'message' =>'Validation fails',
                'errors'=> $validator->errors()
            ],422);
        }
        $user = User::where('email', $request->email)->first();
        if($user){
            if(Hash::check($request->password, $user->password)){

                $token = $user->createToken('auth-token')->plainTextToken;
                return response()->json([
                    'message'=> 'LoginSuccessful',
                    'token' => $token,
                    'data'=>$user
                ],200);

            }
        }
    }
    
    // public function deleteinfo(Request $request,$id){
    //     $users = User::findOrFail($id);
    //     if($users){
    //         $users->delete();
    //         return response()->json([
    //             'message'=>'admin succsessfull delete'
    //         ]);
    //     }else{
    //         return response()->json([
    //             'error'=> 'Admin not found !'
    //         ]);
    //     }
    // }
}
