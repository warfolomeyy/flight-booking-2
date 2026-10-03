<?php

namespace App\Services;

use App\Actions\Cart\AddToCartAction;
use App\Models\Cart;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CartService
{
    public function addToCart(int $userId, int $productId, AddToCartAction $action): JsonResponse
    {
        return $action->execute($userId, $productId);
    }

    public function getCartItems(int $userId)
    {
        return Cart::with('product')->where('user_id', $userId)->get();
    }

    public function removeFromCart(int $userId, int $cartId): JsonResponse
    {
        $cartItem = Cart::find($cartId);

        if (!$cartItem) {
            return response()->json([
                'message' => 'Not found'
            ], 404);
        }

        if ($cartItem->user_id !== $userId) {
            return response()->json([
                'message' => 'Forbidden for you'
            ], 403);
        }

        $cartItem->delete();

        return response()->json([
            'message' => 'Item removed from cart'
        ], 200);
    }
}
