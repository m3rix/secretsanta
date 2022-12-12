<?php

use App\Http\Controllers\Api\V1\wishlistController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'V1'], function(){
    Route::apiResource('wishlist', wishlistController::class);
});
