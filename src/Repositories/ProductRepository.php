<?php

namespace App\Repositories;

use App\DB\Database;
use App\Interfaces\ProductRepositoryInterface;
use App\Models\ProductModel;
use Exception;
use PDO;

class ProductRepository implements ProductRepositoryInterface
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function getAllProduct(): array
    {
        $stmt = $this->db->query("SELECT * FROM products ORDER BY id DESC");
        $rows = $stmt->fetchAll();
        $out = [];
        if (count($rows) === 0) {
            return $out;
        }
        foreach ($rows as $row) {
            $out[] = new ProductModel($row["id"], $row["title"], (float) $row["price"], (int) $row["available_quantity"]);
        }

        return $out;
    }

    public function getProductById(string $id): ?ProductModel
    {
        $stmt = $this->db->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) {
            return null;
        }

        $product = new ProductModel($row["id"], $row["title"], $row["price"], $row['available_quantity']);

        return $product;
    }

    public function createProduct(ProductModel $product): ?string
    {
        $stmt = $this->db->prepare("INSERT INTO products (title, price, available_quantity) VALUES (?, ?, ?)");
        $stmt->execute([
            $product->getTitle(),
            $product->getPrice(),
            $product->getAvailableQuantity()
        ]);

        $insertedId = null;
        if (!$stmt) {
            return $insertedId;
        }
        $insertedId = $this->db->lastInsertId();
        return $insertedId;
    }

    public function updateProduct(ProductModel $product): ?string
    {
        $stmt = $this->db->prepare("UPDATE products SET title = ?, price = ?, available_quantity = ? WHERE id = ?");
        $stmt->execute([
            $product->getTitle(),
            $product->getPrice(),
            $product->getAvailableQuantity(),
            $product->getId()
        ]);
        if (!$stmt) {
            return null;
        }

        return $product->getId();
    }

    public function deleteProduct(string $id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM products WHERE id = ?");
        return $stmt->execute([$id]);;
    }
}
