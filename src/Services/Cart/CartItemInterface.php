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

use TBCD\Webshop\Entity\Article;

interface CartItemInterface
{

    /**
     * Return the article of the cart item
     *
     * @return Article
     */
    public function getArticle(): Article;

    /**
     * Return the quantity (number of the same article) of the cart item
     *
     * @return int
     */
    public function getQuantity(): int;

}