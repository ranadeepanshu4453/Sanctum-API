<?php

use App\Http\Controllers\API\ArticleController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('register',[AuthController::class,'register']);
Route::post('login',[AuthController::class,'login']);


Route::middleware('auth:sanctum')->group(function(){
    Route::post('logout',[AuthController::class,'logout']);

    Route::apiResource('posts',PostController::class);
    
    Route::post('addArticle',[ArticleController::class,'add']);

    Route::get('showArticle',[ArticleController::class,'show']);

});
Route::put('updateArticle',[ArticleController::class,'update']);





