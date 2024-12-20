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
 * From 21/10/2024
 */

namespace TBCD\Webshop\Tests;

use TBCD\Webshop\Services\Cart\CartInterface;

class FakeCart implements CartInterface
{

    private readonly array $items;

    public function __construct(array $items)
    {
        $this->items = $items;
    }

    /**
     * @inheritDoc
     */
    public function getItems(): iterable
    {
        return $this->items;
    }
}