<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\addWish;
use App\Http\Resources\V1\WishlistResource;
use App\Models\wishlist;
use Illuminate\Http\Request;

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

    public function destroy(addWish $request, wishlist $wishlist): \Illuminate\Http\JsonResponse
    {
        $wishlist->update($request->validated());
        return response()->json("Wish updated");
    }
}
