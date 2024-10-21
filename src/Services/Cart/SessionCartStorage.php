<?php

/*
 * This file is part of the tbcd/cas project.
 *
 * (c) Thomas Beauchataud <thomas.beauchataud@yahoo.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Author Thomas Beauchataud
 * From 01/09/2024
 */

namespace TBCD\Webshop\Services\Cart;

use Symfony\Component\HttpFoundation\RequestStack;

class SessionCartStorage implements CartStorageInterface
{

    private const CART_SESSION = 'CART_SESSION';

    private readonly RequestStack $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    /**
     * @inheritDoc
     */
    public function get(): ?CartInterface
    {
        return $this->requestStack->getSession()->get(self::CART_SESSION);
    }

    /**
     * @inheritDoc
     */
    public function save(CartInterface $cart): CartInterface
    {
        $this->requestStack->getSession()->set(self::CART_SESSION, $cart);
        return $cart;
    }

    /**
     * @inheritDoc
     */
    public function delete(): void
    {
        $this->requestStack->getSession()->remove(self::CART_SESSION);
    }
}