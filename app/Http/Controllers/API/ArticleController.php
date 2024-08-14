<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ArticleController extends Controller
{
    public function add(Request $request){
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

            $path=$request->file('image')->store('images','public');

        $article=Article::create([
            'title'=>$request->title,
            'description'=>$request->description,
            'path'=>$path,
        ]);
        return response()->json([
            'status'=>true,
            'message'=>'New Article Added',
            'article'=>$article,
        ],200);
    }
    public function show(){
        $data=Article::all();
        return response()->json([
            'status'=>true,
            'message'=>'Article data fetched successfully',
            'Data'=>$data,
        ],200);
    }
    public function update(Request $request){
        dd($request->title);
        $request->validate([
            'title'=>'required',
            'description'=>'required',
        ]);
        
        $article=Article::find(4);
        if (!$article) {
            return response()->json([
                'status' => false,
                'message' => 'Article not found',
            ], 404);
        }
        $article->update($request->only(['title', 'description']));
        
        $article->save();
        return response()->json([
            'status'=>true,
            'message'=>'Article Updated Successfully',
            'Article'=>$article,
        ],200);
    }
    public function delete(){

    }
    
}
