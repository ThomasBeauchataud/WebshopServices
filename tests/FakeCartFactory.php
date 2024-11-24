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

use TBCD\Webshop\Services\Cart\CartFactoryInterface;
use TBCD\Webshop\Services\Cart\CartInterface;

class FakeCartFactory implements CartFactoryInterface
{

    /**
     * @inheritDoc
     */
    public function create(): CartInterface
    {
        return new FakeCart([]);
    }
}