<?php

class cartItem
{
    private Product $product;
    private int $quantity = 0;

    public function __construct(Product $product, int $quantity)
    {
        $this->product = $product;
        $this->quantity = $quantity;
    }

    public function getProduct()
    {
        return $this->product;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function increaseQuantity(int $quantity = 1)
    {
        if ($this->getQuantity() + $quantity > $this->getProduct()->getAvailableQuantity()) {
            throw new Exception("Product quantity can't be more than" . $this->getProduct()->getAvailableQuantity());
        }

        $this->quantity += $quantity;
    }

    public function decreaseQuantity(int $quantity = 1)
    {
        if ($this->getQuantity() - $quantity < 1) {
            throw new Exception("Product quantity can't be less than 1");
        }

        $this->quantity -= $quantity;
    }
}
