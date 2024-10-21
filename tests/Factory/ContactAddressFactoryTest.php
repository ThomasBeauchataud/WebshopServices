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
use TBCD\Webshop\Entity\ContactAddress;
use TBCD\Webshop\Factory\ContactAddressFactory;
use Zenstruck\Foundry\Test\Factories;

class ContactAddressFactoryTest extends TestCase
{

    use Factories;

    /**
     * @return void
     */
    public function testCreate(): void
    {
        $contactAddressFactory = ContactAddressFactory::new();
        $contactAddress = $contactAddressFactory->create();
        $this->assertInstanceOf(ContactAddress::class, $contactAddress);
    }
}