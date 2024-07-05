<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Models\User;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});




//CRUD for category
Route::group([],function(){
Route::get('/category ', [CategoryController::class, 'all']);
Route::get('/category/get/{id}', [CategoryController::class, 'show']);
Route::delete('/category/delete/{id}', [CategoryController::class, 'delete']);
Route::post('/category/insert', [CategoryController::class, 'insert']);
Route::put('/category/update/{id}', [CategoryController::class, 'update']);
});

//CRUD for Users
Route::group([],function(){
Route::get('/User', [UserController::class, 'all']);
Route::get('/User/get/{id}', [UserController::class, 'show']);
Route::delete('/User/delete/{id}', [UserController::class, 'delete']);
Route::post('/User/insert', [UserController::class, 'insert']);
Route::put('/User/update/{id}', [UserController::class, 'update']);
});
Route::group([],function(){});
Route::group([],function(){});
Route::group([],function(){});
Route::group([],function(){});

