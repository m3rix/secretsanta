<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\addWish;
use App\Http\Resources\v1\WishlistResource;
use App\Models\wishlist;

class wishlistController extends Controller
{
    public function index() {
        return WishlistResource::collection(wishlist::all());
    }

    public function store(addWish $request): \Illuminate\Http\JsonResponse
    {
        wishlist::create($request->validated());
        return response()->json("Wish added");
    }

    public function update(addWish $request, wishlist $wishlist): \Illuminate\Http\JsonResponse
    {
        $wishlist->update($request->validated());
        return response()->json("Wish updated");
    }

    public function show(wishlist $wishlist): WishlistResource
    {
        return new WishlistResource($wishlist);
    }

    public function destroy(wishlist $wishlist): \Illuminate\Http\JsonResponse
    {
        $wishlist->delete();
        return response()->json("Wish deleted");
    }
}
