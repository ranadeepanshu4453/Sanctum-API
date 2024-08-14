<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['posts']=Post::all();
        return response()->json([
            'status'=>true,
            'message'=>'All Post Data',
            'data'=>$data,
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate=Validator::make(
            $request->all(),
            [
                'title'=>'required',
                'description'=>'required',
                'image'=>'required|mimes:png,jpg,jpeg,gif',
            ]
            );
            if($validate->fails()){
                return response()->json([
                    'status'=>false,
                    'message'=>'Validation Error',
                    'errors'=>$validate->errors()->all(),
                ],401);
            }
            //code for image upload
            $img=$request->image;
            $text=$img->getClientOriginalExtension();
                $imagename=time().'.'.$text;
                $img->move(public_path().'/uploads',$imagename);
            //

            $post=Post::create([
                'title'=>$request->title,
                'description'=>$request->description,
                'image'=>$imagename,
            ]);
            return response()->json([
                'status'=>true,
                'message'=>'Post Added Successfully',
                'post'=>$post,
            ],200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data['post']=Post::select(
            'id',
            'title',
            'description',
            'image',
        )->where(['id'=>$id])->get();

        return response()->json([
            'status'=>true,
            'message'=>'Your Single Post',
            'data'=>$data,
        ],200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validate=Validator::make(
            $request->all(),
            [
                'title'=>'required',
                'description'=>'required',
                'image'=>'required|mimes:png,jpg,jpeg,gif',
            ]
            );
            if($validate->fails()){
                return response()->json([
                    'status'=>false,
                    'message'=>'Validation Error',
                    'errors'=>$validate->errors()->all(),
                ],401);
            }

            $post=Post::select('id','image')->get();
            if($request->image!=''){
                $path=public_path().'/uploads';

                if($post->image != '' && $post->image !=null){
                    $old_file=$path.$post->image;
                    if(file_exists($old_file)){
                        unlink($old_file);
                    }
                }
                $img=$request->image;
                $text=$img->getClientOriginalExtension();
                    $imagename=time().'.'.$text;
                    $img->move(public_path().'/uploads',$imagename);

            }else{
                    $imagename=$post->image;
            }

            //code for image upload
            // $img=$request->image;
            // $text=$img->getClientOriginalExtension();
            //     $imagename=time().'.'.$text;
            //     $img->move(public_path().'/uploads',$imagename);
            //

            $post=Post::where(['id'=>$id])->update([
                'title'=>$request->title,
                'description'=>$request->description,
                'image'=>$imagename,
            ]);
            return response()->json([
                'status'=>true,
                'message'=>'Post Updated Successfully',
                'post'=>$post,
            ],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $imagepath=Post::select('image')->where('id',$id)->get();
        $filepath=public_path().'/uploads'.$imagepath[0]['image'];
        unlink($filepath);
        
        $post=Post::where('id',$id)->delete();
        return response()->json([
            'status'=>true,
                'message'=>'Post Removed',
                'post'=>$post,
        ],200);
    }
}
