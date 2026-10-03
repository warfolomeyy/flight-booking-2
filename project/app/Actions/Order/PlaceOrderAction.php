<?php

namespace App\Actions\Order;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\JsonResponse;

class PlaceOrderAction
{
    public function execute(int $userId): JsonResponse
    {

        $cartItems = Cart::with('product')->where('user_id', $userId)->get();


        if ($cartItems->isEmpty()) {
            return response()->json([
                'error' => [
                    'code' => 422,
                    'message' => 'Cart is empty'
                ]
            ], 422);
        }


        $productIds = [];
        $totalPrice = 0;

        foreach ($cartItems as $item) {
            $productIds[] = $item->product_id;
            $totalPrice += $item->product->price;
        }

        $order = Order::create([
            'user_id' => $userId,
            'products' => $productIds,
            'order_price' => $totalPrice,
            ]);

        Cart::where('user_id', $userId)->delete();

        return response()->json([
            'order id' => $order->id,
            'message' => 'Order is processed'
        ], 201);
    }
}
