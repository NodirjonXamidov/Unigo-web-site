<?php

namespace App\Http\Controllers;

use App\Models\scholarshipsWon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ScholarshipsWonController extends Controller
{

    public function indexScholarships(){
        return $count = scholarshipsWon::all();
      }
  
      public function createScholarship(Request $request){
         $valitator = Validator::make($request->all(),[
          'count'=>'required'
         ]);
         
         if(!$valitator ->fails()){
          $count = scholarshipsWon::create([
              'count'=>$request->count
          ]);
          return response()->json([
              'message'=>'Create Succsessful'
          ]);
         }else{
          return null;
         }
      }
  
      public function joiningScholarship(Request $request,$id){
          $count = scholarshipsWon::find($id);
          if($count){
              $count->count += $request->count;
              $count->update();
              return response()->json([
                  'message'=> $count ? 'Success Addition Won' : 'Something  wrong error'
              ]);
          }
      }
  
}
