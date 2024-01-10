<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function information(){
       return response()->json([ 
        $user = User::all()
    ]);
    }


    public function updateInfo(Request $request, $id){
        $userInfo = User::find($id);
        if(!$userInfo){
            return response()->json([
                'message'=>$userInfo->error()
            ]);
        }else{

            $userInfo->name = $request->name;
            $userInfo->email = $request->email;
           
            $userInfo->password = $request->password;
            $userInfo->update();
            $userInfo->save();
        
        }
        return response()->json([
            'message'=>'update successfully'
        ]);

    }
}
