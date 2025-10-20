<?php

namespace App\Repositories;

use App\DB\Database;
use App\Interfaces\ProductRepositoryInterface;
use App\Models\ProductModel;
use PDO;

class ProductRepository implements ProductRepositoryInterface
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function getAllProduct(ProductModel $product): array
    {
        $stmt = $this->db->query("SELECT * FROM products ORDER BY id DESC");
        $rows = $stmt->fetchAll();
        $out = [];

        foreach ($rows as $row) {
            $out[] = new ProductModel($row["id"], $row["title"], (float) $row["price"], (int) $row["available_quantity"]);
        }

        return $out;
    }

    public function getProductById(string $id): ProductModel
    {
        $stmt = $this->db->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch();

        $product = new ProductModel($row["id"], $row["title"], $row["price"], $row['available_quantity']);

        return $product;
    }

    public function createProduct(ProductModel $product): bool
    {
        $stmt = $this->db->prepare("INSERT INTO products (title, price, available_quantity) VALUES (?, ?, ?)");
        $stmt->execute([
            $product->getTitle(),
            $product->getPrice(),
            $product->getAvailableQuantity()
        ]);

        return true;
    }

    public function updateProduct(ProductModel $product): bool
    {
        if ($product->getId() === null)
            return false;
        $stmt = $this->db->prepare("UPDATE products SET title = ?, price = ?, available_quantity = ? WHERE id = ?");
        return $stmt->execute([
            $product->getTitle(),
            $product->getPrice(),
            $product->getAvailableQuantity(),
            $product->getId()
        ]);
    }

    public function deleteProduct(string $id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM products WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
