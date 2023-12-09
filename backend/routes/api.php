<?php

use App\Http\Controllers\api\v1\wishlistController;
use App\Http\Controllers\UserController;
use Illuminate\Routing\Route;


Route::group(['prefix' => 'v1'], function(){
    Route::apiResource('wishlist', wishlistController::class);
});

Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);
