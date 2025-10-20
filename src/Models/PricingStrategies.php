<?php

namespace App\Models;

interface PricingStrategy
{
    public function calculate(Cart $cartItem): float;
}


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


class DiscountPrice implements PricingStrategy
{
    public function calculate(Cart $cartItem): float
    {
        $totalSum = 0;
        foreach ($cartItem->getItems() as $item) {
            $totalSum += $item->getQuantity() * $item->getProduct()->getPrice();
        }

        return $totalSum * 0.9;
    }
}
