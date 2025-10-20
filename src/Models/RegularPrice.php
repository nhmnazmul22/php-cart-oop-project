<?php

namespace App\Models;

use App\Models\Cart;
use App\Models\PricingStrategy;

class RegularPrice implements PricingStrategy
{
    public function calculate(Cart $cartItem): float
    {
        $totalSum = 0;
        foreach ($cartItem->getItems() as $item) {
            $totalSum += $item->getQuantity() * $item->getProduct()->getPrice();
        }

        return $totalSum;
    }
}
