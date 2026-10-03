<?php

namespace App\Services;

use App\Actions\Order\PlaceOrderAction;
use App\Models\Order;
use Illuminate\Http\JsonResponse;

class OrderService
{
    public function placeOrder(int $userId, PlaceOrderAction $action): JsonResponse
    {
        return $action->execute($userId);
    }

    public function getOrders(int $userId)
    {
        return Order::where('user_id', $userId)->get();
    }
}
