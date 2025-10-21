<?php

namespace App\Interfaces;

use App\Models\ProductModel;

interface ProductRepositoryInterface
{
    /**
     * Summary of getAllProduct
     * @return ProductModel[]
     */
    public function getAllProduct(): array;

    /**
     * Summary of getProductById
     * @param string $id
     * @return ?ProductModel
     */
    public function getProductById(string $id): ?ProductModel;

    /**
     * Summary of createProduct
     * @param ProductModel $product
     * @return ?string
     */
    public function createProduct(ProductModel $product): ?string;

    /**
     * Summary of updateProduct
     * @param ProductModel $product
     * @return ?
     */
    public function updateProduct(ProductModel $product): ?string;

    /**
     * Summary of deleteProduct
     * @param string $id
     * @return bool
     */
    public function deleteProduct(string $id): bool;
}
