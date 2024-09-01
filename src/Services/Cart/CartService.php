<?php

namespace TBCD\Webshop\Services\Cart;

use App\Entity\Cart;

class CartService implements CartServiceInterface
{

    private readonly CartFactoryInterface $cartFactory;
    private readonly CartStorageInterface $cartStorage;

    public function __construct(CartFactoryInterface $cartFactory, CartStorageInterface $cartStorage)
    {
        $this->cartFactory = $cartFactory;
        $this->cartStorage = $cartStorage;
    }


    /**
     * @inheritDoc
     */
    public function getCart(): Cart
    {
        $cart = $this->cartStorage->get();

        if ($cart == null) {
            $cart = $this->cartFactory->create();
            $this->saveCart($cart);
        }

        return $cart;
    }

    /**
     * @inheritDoc
     */
    public function saveCart(Cart $cart): Cart
    {
        return $this->cartStorage->save($cart);
    }
}