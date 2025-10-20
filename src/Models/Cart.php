<?php

namespace App\Models;

use App\Interfaces\ICartCalculation;
use App\Interfaces\ICartOperations;
use App\Models\PricingStrategy;

class Cart implements ICartCalculation, ICartOperations
{
    /**
     *
     * @var cartItem[]
     */
    private array $cartItems = [];
    private PricingStrategy $pricingStrategy;

    public function __construct(PricingStrategy $strategy)
    {
        $this->pricingStrategy = $strategy;
    }

    public function getItems(): array
    {
        return $this->cartItems;
    }

    private function findProduct(int $productId)
    {
        return $this->cartItems[$productId] ?? null;
    }

    public function addProduct(ProductModel $product, int $quantity): cartItem
    {
        // find the product in cart
        $cartItem = $this->findProduct($product->getId());

        if ($cartItem === null) {
            $cartItem = new cartItem($product, 0);
            $this->cartItems[$product->getId()] = $cartItem;
        }

        $cartItem->increaseQuantity($quantity);
        return $cartItem;
    }

    public function removeProduct(ProductModel $product): void
    {
        $cartItem = $this->findProduct($product->getId());
        $index = array_search($cartItem, $this->cartItems);
        unset($this->cartItems[$index]);
    }

    public function getTotalQuantity(): int
    {
        $sum = 0;
        foreach ($this->cartItems as $item) {
            $sum += $item->getQuantity();
        }

        return $sum;
    }

    public function getTotalSum(): float
    {
        return $this->pricingStrategy->calculate($this);
    }
}
