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
 * From 22/10/2024
 */

namespace TBCD\Webshop\Tests\Factory;

use PHPUnit\Framework\TestCase;
use TBCD\Webshop\Entity\Article;
use TBCD\Webshop\Factory\ArticleFactory;
use Zenstruck\Foundry\Test\Factories;

class ArticleFactoryTest extends TestCase
{

    use Factories;

    /**
     * @return void
     */
    public function testCreate(): void
    {
        $articleAddressFactory = ArticleFactory::new();
        $article = $articleAddressFactory->create();
        $this->assertInstanceOf(Article::class, $article);
    }
}