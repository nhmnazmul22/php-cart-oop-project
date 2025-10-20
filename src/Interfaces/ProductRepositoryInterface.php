<?php

namespace App\Interfaces;

use App\Models\ProductModel;

interface ProductRepositoryInterface
{
    /**
     * Summary of getAllProduct
     * @param ProductModel $product
     * @return ProductModel[]
     */
    public function getAllProduct(ProductModel $product): array;

    /**
     * Summary of getProductById
     * @param string $id
     * @return ProductModel
     */
    public function getProductById(string $id): ProductModel;

    /**
     * Summary of createProduct
     * @param ProductModel $product
     * @return bool
     */
    public function createProduct(ProductModel $product): bool;

    /**
     * Summary of updateProduct
     * @param ProductModel $product
     * @return bool
     */
    public function updateProduct(ProductModel $product): bool;

    /**
     * Summary of deleteProduct
     * @param string $id
     * @return bool
     */
    public function deleteProduct(string $id): bool;
}
