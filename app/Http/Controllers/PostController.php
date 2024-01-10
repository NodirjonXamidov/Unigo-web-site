<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostStoreRequest;
use App\Models\Post;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index(){
        return response()->json([
            'message'=> $post = Post::all()
        ]);
    }


    public function show(Request $request, $id){
        $post = Post::find($id);
        if(!$post){
            return response()->json([
                'message'=>$post->error()
            ]);
        }else{
            return response()->json([
                'post'=>$post
            ]);
        }
    }



    public function store(PostStoreRequest $request){

        try{

            $imageName = Str::random(32).".".$request->image->getClientOriginalExtension();

            Post :: create([
                'name'=>$request->name,
                'image'=>$request->image,
                'description'=>$request->description
            ]);
            
            Storage::disk('public')->put($imageName,file_get_contents($request->image));

            return response()->json([
                'message'=>' Product successfully created.'
            ],200);

        }catch(\Exception $e){
            return response()->json([
                'message' => 'Something went really wrong !',
                'error'=>$e->getMessage()
            ]);
        }

    }

    public function update(PostStoreRequest $request,$id){
        try{
            $post = Post::find($id);
            if(!$post){
                return response()->json([
                    'message'=> 'Post Not Found'
                ]);
            }

            $post->name = $request->name;
           
            $post->description ??= $request->description;
           
           

            if($request->image){
                
                $storage =Storage::disk('public');

                if($storage->exists($post->image))
                $storage->delete($post->image);


                //name
                $imageName = Str::random(32).".".$request->image->getClientOriginalExtension();
                $post->image = $imageName;

                $storage->put($imageName,file_get_contents($request->image));
            }

            $post->save();
            return response()->json([
                'message'=>'Post Successfully update'
            ]);

        }catch(\Exception $e){
            return response()->json([
                'message' => 'Something went really wrong !',
                'error'=>$e->getMessage()
            ]);
        }
    }

    public function delete(Request $request, $id){
        $post = Post::find($id);
        if($post){
         $post->delete() ? 'Post delete' : '';
        }
    }
}
