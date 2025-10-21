<?php
require __DIR__ . "/vendor/autoload.php";

use App\Controllers\CartController;
use App\Controllers\ProductController;
use Bramus\Router\Router;

$router = new Router();

// Get All Products
$router->get("/products", function () {
    $controller = new ProductController();
    $controller->showAllProduct();
});

// Get Product by id
$router->get("/products/(\w+)", function (string $id) {
    $controller = new ProductController();
    $controller->showProductById($id);
});

// Create new Product
$router->post("/products", function () {
    $controller = new ProductController();
    $controller->createNewProduct();
});

// Update Products
$router->put("/products/(\w+)", function (string $id) {
    $controller = new ProductController();
    $controller->updateExistsProduct($id);
});

// Delete Products
$router->delete("/products/(\w+)", function (string $id) {
    $controller = new ProductController();
    $controller->deleteExistsProduct($id);
});




// Run the router
$router->run();
