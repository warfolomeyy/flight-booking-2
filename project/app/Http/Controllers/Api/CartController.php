<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\CartService;
use App\Actions\Cart\AddToCartAction;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\CartResource;

class CartController extends Controller
{
    protected CartService $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }


    public function index(Request $request): JsonResponse
    {
        $items = $this->cartService->getCartItems($request->user()->id);

        return response()->json(CartResource::collection($items)->resolve(), 200);
    }

    public function store(Request $request, $productId, AddToCartAction $action): JsonResponse
    {
        return $this->cartService->addToCart($request->user()->id, (int)$productId, $action);
    }

    public function destroy(Request $request, $id): JsonResponse
    {
        return $this->cartService->removeFromCart($request->user()->id, (int)$id);
    }
}
