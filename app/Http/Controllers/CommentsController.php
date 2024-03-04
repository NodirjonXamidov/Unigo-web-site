<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CommentsController extends Controller
{
    public function indexComment(){
        return response()->json([
            $comments = Comments::all()
        ]);
    }

    public function createComment(Request $request){
        $validator = Validator::make($request->all(),[
            'name'=>'required',
            'university'=>'required',
            'description'=>'required',
        ]);
        if(!$validator){
            return response()->json([
                'message'=>$validator->errors()
            ]);
        }else{
            $comment = Comments::create([
                'name' => $request->name,
                'university' => $request->university,
                'description' => $request->description,
            ]);
            return response()->json([
                'message'=>'Succsessfull create comment !'
            ]);
        }
    }

    public function updateComment(Request $request, $id){
        $comment = Comments::find($id);
        if(!$comment){
            return response()->json([
                'message'=>$comment->errors() 
            ]);
        }else{
            $comment->name = $request->name ? $request->name : $comment->name;
            $comment->university = $request->university ? $request->university : $comment->university;
            $comment->description = $request->description ? $request->description : $comment->description;
           
        }
        return response()->json([
            'message'=>'Succsessfull update comment !'
        ]);
    }

    public function deleteComment(Request $request, $id){
        $comment = Comments::find($id);
        if($comment){
            return response()->json([
                'message'=> $comment->delete() ? 'Comment Succsessfull delete':''
            ]);
        }else{
            return $comment->errors();
        }
    }
}
