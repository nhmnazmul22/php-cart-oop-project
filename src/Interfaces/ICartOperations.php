<?php

namespace App\Interfaces;
use App\Models\cartItem;
use App\Models\Product;

interface ICartOperations
{
    public function addProduct(Product $product, int $quantity): cartItem;
    public function removeProduct(Product $product): void;
    public function getItems(): array;
}
