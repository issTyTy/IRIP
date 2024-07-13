<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Get authenticated user
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// CRUD for categories
Route::group(['prefix' => 'category'], function () {
    Route::get('/', [CategoryController::class, 'all']);
    Route::get('/{id}', [CategoryController::class, 'show']);
    Route::delete('/{id}', [CategoryController::class, 'delete']);
    Route::post('/', [CategoryController::class, 'insert']);
    Route::put('/{id}', [CategoryController::class, 'update']);
});

// CRUD for users
Route::group(['prefix' => 'user'], function () {
    Route::get('/', [UserController::class, 'all']);
    Route::get('/{id}', [UserController::class, 'show']);
    Route::delete('/{id}', [UserController::class, 'delete']);
    Route::post('/', [UserController::class, 'insert']);
    Route::put('/{id}', [UserController::class, 'update']);
});

// Auth routes
Route::group(['middleware' => 'api', 'prefix' => 'auth'], function () {
    Route::post('/login', [AuthController::class, 'login'])->name('login'); // Ensure to name the login route
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout'); // Ensure to name the logout route
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);
});

// CRUD for products
Route::group(['prefix' => 'product'], function () {
    Route::get('/', [ProductController::class, 'all'])->middleware('auth');
    Route::get('/{id}', [ProductController::class, 'show'])->middleware('auth');
    Route::delete('/{id}', [ProductController::class, 'delete'])->middleware('is_admin');
    Route::post('/', [ProductController::class, 'insert'])->middleware('is_admin');
    Route::put('/{id}', [ProductController::class, 'update'])->middleware('is_admin');
});

// CRUD for orders
Route::group([],function(){
Route::get('/order', [OrderController::class, 'all']);
Route::get('/order/get/{id}', [OrderController::class, 'show']);
Route::get('/order/get_order_items/{id}', [OrderController::class, 'get_order_items']);
Route::get('/order/get_user_orders/{id}', [OrderController::class, 'get_user_orders']);
Route::put('/order/update/{id}', [OrderController::class, 'update']);
Route::post('/order/store', [OrderController::class, 'store']);
Route::delete('/order/delete/{id}', [OrderController::class, 'delete']);
});

Route::middleware('auth')->group(function (){
    Route::post('/cart/add', [CartController::class, 'addToCart']);
    Route::get('/cart', [CartController::class, 'viewCart']);
    Route::put('/cart/update/{itemId}', [CartController::class, 'updateCartItem']);
    Route::delete('/cart/remove/{itemId}', [CartController::class, 'removeCartItem']);
});

