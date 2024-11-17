<?php

namespace TBCD\Webshop\Factory;

use TBCD\Webshop\Entity\Shipment;
use Zenstruck\Foundry\ObjectFactory;

final class ShipmentFactory extends ObjectFactory
{

    /**
     * @inheritDoc
     */
    public static function class(): string
    {
        return Shipment::class;
    }

    /**
     * @inheritDoc
     */
    protected function defaults(): array|callable
    {
        return [
            'reference' => self::faker()->uuid(),
            'destination' => ContactAddressFactory::new(),
            'origin' => ContactAddressFactory::new()
        ];
    }
}
