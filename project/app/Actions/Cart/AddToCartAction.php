<?php

namespace App\Actions\Cart;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\JsonResponse;

class AddToCartAction
{
    public function execute(int $userId, int $productId): JsonResponse
    {
        $product = Product::find($productId);

        if (!$product) {
            return response()->json([
                'message' => 'Not found'
            ], 404);
        }

        Cart::create([
            'user_id' => $userId,
            'product_id' => $product->id,
        ]);

        return response()->json([
            'message' => 'Product add to card'
        ], 201);
    }
}
