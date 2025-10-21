<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Repositories\ProductRepository;
use Exception;

class ProductController
{
    private ProductRepository $repo;

    public function __construct()
    {
        $this->repo = new ProductRepository();
    }

    // Get all Products
    public function showAllProduct()
    {
        try {
            header("Content-Type: application/json");
            $products = $this->repo->getAllProduct();

            if (count($products) === 0) {
                throw new Exception("Products not found", 404);
            }

            $arr = array_map(fn(ProductModel $product) => $product->toArray(), $products);
            http_response_code(200);
            $response = [
                "success" => true,
                "data" => $arr,
            ];
            echo json_encode($response);
        } catch (Exception $err) {
            http_response_code($err->getCode() ?? 500);
            $response = [
                "success" => false,
                "message" => $err->getMessage(),
            ];
            echo json_encode($response);
        }
    }

    // Get Product By Id
    public function showProductById(string $id)
    {
        try {
            header("Content-Type: application/json");
            $product = $this->repo->getProductById($id);
            if (!$product) {
                throw new Exception("Product not found with ID $id", 404);
            }
            $response = [
                "success" => true,
                "data" => $product->toArray()
            ];
            http_response_code(200);
            echo json_encode($response);
        } catch (Exception $err) {
            http_response_code($err->getCode() ?? 500);
            $response = [
                "success" => false,
                "message" => $err->getMessage(),
            ];
            echo json_encode($response);
        }
    }

    // Create Product
    public function createNewProduct()
    {
        try {
            header("Content-Type: application/json");
            $data = json_decode(file_get_contents("php://input"), true);

            if (!is_array($data) || empty($data) || !isset($data["title"]) || !isset($data["price"]) || !isset($data["available_quantity"])) {
                throw new Exception("Invalid Input, Please, insert title, price and available_quantity", 400);
            }

            $product = new ProductModel("", $data["title"], $data["price"], $data["available_quantity"]);
            $id = $this->repo->createProduct($product);
            if (!$id) {
                throw new Exception("Product create failed",);
            }
            $response = [
                "success" => true,
                "data" => $product->toArray($id)
            ];
            http_response_code(201);
            echo json_encode($response);
        } catch (Exception $err) {
            http_response_code($err->getCode() ?? 500);
            $response = [
                "success" => false,
                "message" => $err->getMessage(),
            ];
            echo json_encode($response);
        }
    }

    // Update Product
    public function updateExistsProduct(string $id)
    {
        try {
            header("Content-Type: application/json");
            $data = json_decode(file_get_contents("php://input"), true);
            if (!is_array($data) || empty($data)) {
                throw new Exception("Invalid Input, Please, insert title or price or available_quantity", 400);
            };

            $existProduct = $this->repo->getProductById($id);
            if (!$existProduct) {
                throw new Exception("Product not found with ID $id", 404);
            }

            $productArr = $existProduct->toArray();
            $title = $data["title"] ?? $productArr["title"];
            $price = $data["price"] ?? $productArr["price"];
            $availableQuantity = $data["available_quantity"] ?? $productArr["availableQuantity"];

            $product = new ProductModel($productArr["id"], $title, $price, $availableQuantity);
            $id = $this->repo->updateProduct($product);
            if (!$id) {
                throw new Exception("Product update failed",);
            }
            $response = [
                "success" => true,
                "message" => "ID: $id - Product updated"
            ];
            http_response_code(200);
            echo json_encode($response);
        } catch (Exception $err) {
            http_response_code($err->getCode() ?? 500);
            $response = [
                "success" => false,
                "message" => $err->getMessage(),
            ];
            echo json_encode($response);
        }
    }

    // Delete Product
    public function deleteExistsProduct(string $id)
    {
        try {
            header("Content-Type: application/json");
            $existProduct = $this->repo->getProductById($id);
            if (!$existProduct) {
                throw new Exception("Product not found with ID $id", 404);
            }

            $status = $this->repo->deleteProduct($id);
            if (!$status) {
                throw new Exception("Product delete failed. Please, try again.");
            }
            $response = [
                "success" => true,
                "message" => "ID: $id - Product delete"
            ];
            http_response_code(200);
            echo json_encode($response);
        } catch (Exception $err) {
            http_response_code($err->getCode() ?? 500);
            $response = [
                "success" => false,
                "message" => $err->getMessage(),
            ];
            echo json_encode($response);
        }
    }
}
