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
 * From 25/08/2024
 */

namespace TBCD\Webshop\Services\Cart;

interface CartServiceInterface
{

    /**
     * Return the cart for the current session
     * If the cart doesn't exist, a new cart is created and saved
     *
     * @return CartInterface
     */
    public function getCart(): CartInterface;

    /**
     * Save the given cart for the current session
     *
     * @param CartInterface $cart
     * @return CartInterface
     */
    public function saveCart(CartInterface $cart): CartInterface;

}