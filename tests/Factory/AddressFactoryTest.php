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
use TBCD\Webshop\Entity\Address;
use TBCD\Webshop\Factory\AddressFactory;
use Zenstruck\Foundry\Test\Factories;

class AddressFactoryTest extends TestCase
{

    use Factories;

    /**
     * @return void
     */
    public function testCreate(): void
    {
        $contactAddressFactory = AddressFactory::new();
        $contactAddress = $contactAddressFactory->create();
        $this->assertInstanceOf(Address::class, $contactAddress);
    }
}