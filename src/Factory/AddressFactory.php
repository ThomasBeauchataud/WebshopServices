<?php

namespace TBCD\Webshop\Factory;

use TBCD\Webshop\Entity\Address;
use Zenstruck\Foundry\ObjectFactory;

final class AddressFactory extends ObjectFactory
{

    /**
     * @inheritDoc
     */
    public static function class(): string
    {
        return Address::class;
    }

    /**
     * @inheritDoc
     */
    protected function defaults(): array|callable
    {
        return [
            'street' => self::faker()->address(),
            'firstName' => self::faker()->firstName(),
            'lastName' => self::faker()->lastName(),
            'country' => self::faker()->country(),
            'city' => self::faker()->city(),
            'zipCode' => self::faker()->postcode(),
        ];
    }
}
