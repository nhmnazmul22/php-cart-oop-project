<?php

namespace App\Models;

class ProductModel
{
    private string $id;
    private string $title;
    private float $price;
    private int $availableQuantity;

    public function __construct(string $id, string $title, float $price, int $availableQuantity)
    {
        $this->id = $id;
        $this->title = $title;
        $this->price = $price;
        $this->availableQuantity = $availableQuantity;
    }

    // Getter functions
    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getAvailableQuantity()
    {
        return $this->availableQuantity;
    }


    // Setter functions
    public function setId(string $id)
    {
        $this->id = $id;
    }

    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    public function setPrice(float $price)
    {
        $this->price = $price;
    }

    public function setAvailableQuantity(int $availableQuantity)
    {
        $this->availableQuantity = $availableQuantity;
    }
}
