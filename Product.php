<?php

class Product
{
    private int $id;
    private string $title;
    private float $price;
    private int $availableQuantity;

    // TODO: Generate constructor with all property of class
    // TODO: Generate getter and setter of properties


    public function addToCart(Cart $cart, int $quantity) {}

    public function removeFromCart(Cart $cart) {}
}
