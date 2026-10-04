<?php

namespace App\Actions\Order;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\JsonResponse;

class PlaceOrderAction
{
    public function execute(int $userId): JsonResponse
    {
        $cartItems = Cart::where('user_id', $userId)->get();

        if ($cartItems->isEmpty()) {
            return response()->json(['message' => 'Cart is empty'], 400);
        }

        $totalPrice = $cartItems->sum(function ($cartItem) {
            return $cartItem->product->price;
        });

        $order = Order::create([
            'user_id' => $userId,
            'order_price' => $totalPrice,
        ]);

        foreach ($cartItems as $cartItem) {
            $order->products()->attach($cartItem->product_id);
        }

        Cart::where('user_id', $userId)->delete();

        return response()->json([
            'message' => 'Order created successfully',
            'order_id' => $order->id
        ], 201);
    }
}
