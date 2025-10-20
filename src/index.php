<?php

use App\Models\Cart;
use App\Models\DiscountPrice;
use App\Models\Product;


$product1 = new Product(1, "Iphone 11", 2500, 10);
$product2 = new Product(2, "M2 SSD", 400, 10);
$product3 = new Product(3, "Samsung galaxy S20", 3200, 10);


$cart = new Cart(new DiscountPrice());
$cartItem1 = $cart->addProduct($product1, 1);
$cartItem2 = $cart->addProduct($product2, 1);

echo "Number of items in cart ";
echo $cart->getTotalQuantity() . PHP_EOL;
echo "Total Price of items in cart ";
echo $cart->getTotalSum() . PHP_EOL;


$cartItem2->increaseQuantity();
$cartItem2->increaseQuantity();

echo "Number of items in cart ";
echo $cart->getTotalQuantity() . PHP_EOL;

echo "Total Price of items in cart ";
echo $cart->getTotalSum() . PHP_EOL;


$cart->removeProduct($product2);
echo "Number of items in cart ";
echo $cart->getTotalQuantity() . PHP_EOL;

echo "Total Price of items in cart ";
echo $cart->getTotalSum() . PHP_EOL;
