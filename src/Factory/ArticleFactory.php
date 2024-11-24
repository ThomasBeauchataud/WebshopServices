<?php

namespace TBCD\Webshop\Factory;

use TBCD\Webshop\Entity\Article;
use Zenstruck\Foundry\ObjectFactory;

final class ArticleFactory extends ObjectFactory
{

    /**
     * @inheritDoc
     */
    public static function class(): string
    {
        return Article::class;
    }

    /**
     * @inheritDoc
     */
    protected function defaults(): array|callable
    {
        return [
            'name' => self::faker()->sentence(3),
            'price' => self::faker()->randomFloat(),
            'weight' => self::faker()->randomNumber()
        ];
    }
}
