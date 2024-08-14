<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use phpDocumentor\Reflection\PseudoTypes\True_;

class AuthController extends Controller
{
    //
    public function register(Request $request){
        $validate=Validator::make(
            $request->all(),
            [
                'name'=>'required',
                'email'=>'required|email|unique:users,email',
                'password'=>'required',
            ]
            );
            if($validate->fails()){
                return response()->json([
                    'status'=>false,
                    'message'=>'Validation Error',
                    'errors'=>$validate->errors()->all(),
                ],401);
            }

            $user=User::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>$request->password,
            ]);
            return response()->json([
                'status'=>true,
                'message'=>'User Registered Successfully',
                'user'=>$user,
            ],200);
            // return redirect()->route('login');
    }
    public function login(Request $request){
        $validate=Validator::make(
            $request->all(),
            [
                'email'=>'required|email',
                'password'=>'required',
            ]
            );
            if($validate->fails()){
                return response()->json([
                    'status'=>false,
                    'message'=>'Authentication Failed',
                    'errors'=>$validate->errors()->all(),
                ],404);
            }

            if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
                $user=Auth::user();
                return response()->json([
                    'status'=>true,
                    'message'=>'User LogIn Successfully',
                    'token'=>$user->createToken('API TOKEN')->plainTextToken,
                    'token_type'=>'bearer',
                ],200);
            }else{
                return response()->json([
                    'status'=>false,
                    'message'=>'Username & Password not matched',
                ],401);

            }

    }
    public function logout(Request $request){
        $user=$request->user();
        $user->tokens()->delete();

        return response()->json([
            'status'=>True,
            'user'=>$user,
            'message'=>'You Logged Out Successfully',
        ],200);

    }
}
