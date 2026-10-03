<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\OrderService;
use App\Actions\Order\PlaceOrderAction;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\OrderResource;

class OrderController extends Controller
{
    protected OrderService $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index(Request $request): JsonResponse
    {
        $orders = $this->orderService->getOrders($request->user()->id);

        return response()->json(OrderResource::collection($orders)->resolve(), 200);
    }

    public function store(Request $request, PlaceOrderAction $action): JsonResponse
    {
        return $this->orderService->placeOrder($request->user()->id, $action);
    }
}
