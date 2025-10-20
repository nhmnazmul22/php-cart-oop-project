<?php

namespace App\Controllers;

use App\DB\Database;
use App\Models\Cart;
use App\Models\RegularPrice;
use PDO;

class CartController
{
    private Cart $cart;
    private PDO $db;

    public function __construct()
    {
        $regularPricingStrategy = new RegularPrice();
        $this->cart = new Cart($regularPricingStrategy);

        $this->db = Database::getConnection();
    }

    public function addProduct()
    {
        header("Content-Type: application/json");

        // Read JSON Request body
        $input = json_decode(file_get_contents("php://input"),  true);

        http_response_code(200);
        echo json_encode($input);
        return $input;
    }
}
