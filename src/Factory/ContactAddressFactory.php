<?php

namespace TBCD\Webshop\Factory;

use TBCD\Webshop\Entity\ContactAddress;
use Zenstruck\Foundry\ObjectFactory;

final class ContactAddressFactory extends ObjectFactory
{

    /**
     * @inheritDoc
     */
    public static function class(): string
    {
        return ContactAddress::class;
    }

    /**
     * @inheritDoc
     */
    protected function defaults(): array|callable
    {
        return [
            'email' => self::faker()->email(),
            'phone' => self::faker()->phoneNumber(),
            'street' => self::faker()->address(),
            'firstName' => self::faker()->firstName(),
            'lastName' => self::faker()->lastName(),
            'country' => self::faker()->country(),
            'city' => self::faker()->city(),
            'zipCode' => self::faker()->postcode()
        ];
    }
}
