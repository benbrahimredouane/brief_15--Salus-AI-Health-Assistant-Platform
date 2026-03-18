<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SymptomController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//auth routes
Route::post('/register',[AuthController::class , 'register']);
Route::post('/login',[AuthController::class, 'login']);

//protected routes
Route::middleware('auth:sanctum')->group(function(){

Route::post('/logout',[AuthController::class,'logout']);
Route::post('/me',[AuthController::class,'me']);
//symptoms routes
Route::apiResource('symptoms' , SymptomController::class);



});

