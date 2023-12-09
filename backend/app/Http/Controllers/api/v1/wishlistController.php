<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\addWish;
use App\Http\Resources\v1\WishlistResource;
use App\Models\wishlist;
use App\Models\User;

class wishlistController extends Controller
{
    public function index() {
        $userID = $this->checkAuth();
        return WishlistResource::collection(wishlist::all()->where('user_id', $userID));
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

    private function checkAuth()
    {
        $loggedInUser = User::where('auth_token', request()->bearerToken())->get();
        if ($loggedInUser->isEmpty() || is_null(request()->bearerToken())){
            abort(response()->json(['error' => 'Unauthenticated.'], 401));
        } else {
            $userID = $loggedInUser->value('id');
            return $userID;
        }
    }
}
