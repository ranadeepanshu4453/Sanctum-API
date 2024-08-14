<?php

use App\Http\Controllers\API\ArticleController;
use App\Http\Controllers\API\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('newWelcome');
});

Route::view('register','Forms.register')->name('register');
Route::view('logInUser','Forms.login')->name('login');
Route::view('dashboard','Dashboard.dashboard')->name('dash');

Route::post('NewRegister',[AuthController::class,'register']);
Route::post('Login',[AuthController::class,'login']);
Route::get('Logout',[AuthController::class,'logout']);

// Route::put('updateArticle',[ArticleController::class,'update']);


