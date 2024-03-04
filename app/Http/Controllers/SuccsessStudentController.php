<?php

namespace App\Http\Controllers;

use App\Models\SuccsessStudent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SuccsessStudentController extends Controller
{
    public function indexStudent(){
      return $count = SuccsessStudent::all();
    }

    public function createStudent(Request $request){
       $valitator = Validator::make($request->all(),[
        'countStudent'=>'required'
       ]);
       
       if(!$valitator ->fails()){
        $count = SuccsessStudent::create([
            'countStudent'=>$request->countStudent
        ]);
        return response()->json([
            'message'=>'Create Succsessful'
        ]);
       }else{
        return null;
       }
    }

    public function joining(Request $request,$id){
        $count = SuccsessStudent::find($id);
        if($count){
            $count->countStudent += $request->countStudent;
            $count->update();
            return response()->json([
                'message'=> $count ? 'Success Addition student' : 'Something  wrong error'
            ]);
        }
    }
}
