<?php
require __DIR__ . "/vendor/autoload.php";

use App\Controllers\CartController;
use Bramus\Router\Router;

$router = new Router();

$router->get("/json-encoded", function () {
    $age[] = ["Peter" => 35, "Ben" => 37, "Joe" => 43];
    echo json_encode($age);
});

$router->get("/json-encoded-2", function () {
    $cars = ["Volvo", "BMW", "Toyota"];
    echo json_encode($cars);
});

$router->get("/json-decoded", function () {
    $jsonobj = '{"Peter":35,"Ben":37,"Joe":43}';
    $arr = json_decode($jsonobj,  true);

    // echo $arr["Peter"];
    // echo $arr["Ben"];
    // echo $arr["Joe"];

    foreach ($arr as $key => $value) {
        echo $key . " => " . $value . "<br>";
    }

    // var_dump(json_decode($jsonobj, true));
});

$router->post("/addProduct", function () {
    $controller = new CartController();
    $controller->addProduct();
});

// Run the router
$router->run();
