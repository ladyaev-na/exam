<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthRegController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NewController;
use App\Http\Controllers\AttractionController;
use App\Http\Controllers\CartControler;
use App\Http\Controllers\BuyController;


Route::post('/register',[AuthRegController::class, 'create']);
Route::post('/login',[AuthRegController::class, 'login']);


Route::get('/attraction/category',[AttractionController::class,'showAllC']);
Route::get('/attraction/category/{id}',[AttractionController::class,'showC']);

Route::get('/attraction',[AttractionController::class,'showAll']);
Route::get('/attraction/{id}',[AttractionController::class,'show']);

Route::get('/event',[NewController::class,'showAll']);
Route::get('/event/{id}',[NewController::class,'show']);


Route::middleware('auth:api')->group(function (){

    Route::get('/logout', [AuthRegController::class, 'logout']);

    Route::post('/cart/{id}',[CartControler::class,'add']);
    Route::get('/cart/{id}',[CartControler::class,'show']);
    Route::delete('/cart/{id}',[CartControler::class,'delete']);

    Route::patch('/users/{id}',[UserController::class,'updateUser']);
    Route::delete('/users/{id}',[UserController::class,'deleteUser']);

    Route::post('/buy/{id}',[BuyController::class,'buyCart']);

});


Route::middleware(['auth:api','role:admin'])->group(function (){

    Route::post('/roles',[UserController::class,'createRole']);
    Route::get('/roles',[UserController::class,'readRole']);
    Route::patch('/roles/{id}',[UserController::class,'updateRole']);
    Route::delete('/roles/{id}',[UserController::class,'deleteRole']);

    Route::post('/attraction/category',[AttractionController::class,'createC']);
    Route::patch('/attraction/category/{id}',[AttractionController::class,'updateC']);
    Route::delete('/attraction/category/{id}',[AttractionController::class,'deleteC']);

    Route::post('/attraction',[AttractionController::class,'create']);
    Route::patch('/attraction/{id}',[AttractionController::class,'update']);
    Route::delete('/attraction/{id}',[AttractionController::class,'delete']);

    Route::post('/event',[NewController::class,'create']);
    Route::patch('/event/{id}',[NewController::class,'update']);
    Route::delete('/event/{id}',[NewController::class,'delete']);

});


