<?php

namespace App\Services;

use App\Actions\Product\ManageProductAction;
use App\Models\Product;

class ProductService
{
    public function storeProduct(array $data, ManageProductAction $action): Product
    {
        return $action->create($data);
    }

    public function updateProduct(Product $product, array $data, ManageProductAction $action): Product
    {
        return $action->update($product, $data);
    }

    public function deleteProduct(Product $product, ManageProductAction $action): void
    {
        $action->delete($product);
    }
}
