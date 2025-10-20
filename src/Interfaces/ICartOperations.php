<?php

namespace App\Interfaces;
use App\Models\cartItem;
use App\Models\ProductModel;

interface ICartOperations
{
    public function addProduct(ProductModel $product, int $quantity): cartItem;
    public function removeProduct(ProductModel $product): void;
    public function getItems(): array;
}
