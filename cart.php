<?php




class Cart
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

    public function setItem($cartItem): void
    {
        $this->cartItems[] = $cartItem;
    }

    public function getItems(): array
    {
        return $this->cartItems;
    }


    private function findProduct(int $productId)
    {
        return $this->cartItems[$productId] ?? null;
    }

    public function addProduct(Product $product, int $quantity)
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

    public function removeProduct(Product $product)
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

    public function getTotalSum()
    {


        return $this->pricingStrategy->calculate($this);
    }
}
