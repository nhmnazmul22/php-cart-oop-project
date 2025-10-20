<?php

namespace App\Models;
use App\Models\Cart;

interface PricingStrategy
{
    public function calculate(Cart $cartItem): float;
}




