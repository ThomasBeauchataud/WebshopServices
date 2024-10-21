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

interface CartStorageInterface
{

    /**
     * @return CartInterface|null
     */
    public function get(): ?CartInterface;

    /**
     * @param CartInterface $cart
     * @return CartInterface
     */
    public function save(CartInterface $cart): CartInterface;

    /**
     * @return void
     */
    public function delete(): void;

}