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

use TBCD\Webshop\Entity\Article;
use TBCD\Webshop\Services\Cart\CartItemInterface;

class FakeCartItem implements CartItemInterface
{

    private readonly Article $article;
    private readonly int $quantity;

    public function __construct(Article $article, int $quantity)
    {
        $this->article = $article;
        $this->quantity = $quantity;
    }

    /**
     * @inheritDoc
     */
    public function getArticle(): Article
    {
        return $this->article;
    }

    /**
     * @inheritDoc
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }
}