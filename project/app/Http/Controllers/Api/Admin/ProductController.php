<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Services\ProductService;
use App\Actions\Product\ManageProductAction;
use App\Models\Product;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    protected ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function store(StoreProductRequest $request, ManageProductAction $action): JsonResponse
    {
        $product = $this->productService->storeProduct($request->validated(), $action);

        return response()->json([
            'id' => $product->id,
            'message' => 'Product added'
        ], 201);
    }

    public function update(UpdateProductRequest $request, int $id, ManageProductAction $action): JsonResponse
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Not found'], 404);
        }

        $updatedProduct = $this->productService->updateProduct($product, $request->validated(), $action);

        return response()->json($updatedProduct, 200);
    }

    public function destroy(int $id, ManageProductAction $action): JsonResponse
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Not found'], 404);
        }

        $this->productService->deleteProduct($product, $action);

        return response()->json([
            'message' => 'Product removed'
        ], 200);
    }
}
