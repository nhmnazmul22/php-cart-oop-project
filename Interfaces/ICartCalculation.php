<?php

interface ICartCalculation
{
    public function getTotalQuantity(): int;
    public function getTotalSum(): float;
}
