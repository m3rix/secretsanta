<?php

use App\Http\Controllers\api\v1\wishlistController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1'], function(){
    Route::apiResource('wishlist', wishlistController::class);
});
