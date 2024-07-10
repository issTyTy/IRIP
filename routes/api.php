<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
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
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);
});
//CRUD for Products
Route::group([],function(){
Route::get('/Product', [ProductController::class, 'all']);
Route::get('/Product/get/{id}', [ProductController::class, 'show']);
Route::delete('/Product/delete/{id}', [ProductController::class, 'delete']);
Route::post('/Product/insert', [ProductController::class, 'insert']);
Route::put('/Product/update/{id}', [ProductController::class, 'update']);
});
//CRUD for Orders
Route::group([],function(){
Route::get('/order', [OrderController::class, 'all']);
Route::get('/order/get/{id}', [OrderController::class, 'show']);
Route::get('/order/get_order_items/{id}', [OrderController::class, 'get_order_items']);
Route::get('/order/get_user_orders/{id}', [OrderController::class, 'get_user_orders']);
Route::put('/order/update/{id}', [OrderController::class, 'update']);
Route::post('/order/store', [OrderController::class, 'store']);
Route::delete('/order/delete/{id}', [OrderController::class, 'delete']);
});
Route::group([],function(){});
Route::group([],function(){});

