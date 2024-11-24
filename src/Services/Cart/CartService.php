<?php

namespace TBCD\Webshop\Services\Cart;

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
    public function getCart(): CartInterface
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
    public function saveCart(CartInterface $cart): CartInterface
    {
        return $this->cartStorage->save($cart);
    }

    /**
     * @inheritDoc
     */
    public function deleteCart(): void
    {
        $this->cartStorage->delete();
    }

    /**
     * @inheritDoc
     */
    public function getCartWeight(CartInterface $cart): float
    {
        $weight = 0;
        /** @var CartItemInterface $item */
        foreach ($cart->getItems() as $item) {
            $weight += $item->getArticle()->getWeight() * $item->getQuantity();
        }
        return $weight;
    }

    /**
     * @inheritDoc
     */
    public function getCartItemsPrice(CartInterface $cart): float
    {
        $total = 0;
        /** @var CartItemInterface $item */
        foreach ($cart->getItems() as $item) {
            $total += $item->getArticle()->getPrice() * $item->getQuantity();
        }
        return $total;
    }
}