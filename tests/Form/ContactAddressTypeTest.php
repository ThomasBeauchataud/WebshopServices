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

namespace TBCD\Webshop\Tests\Form;

use Symfony\Component\Form\Test\TypeTestCase;
use TBCD\Webshop\Entity\Address;
use TBCD\Webshop\Entity\ContactAddress;
use TBCD\Webshop\Form\AddressType;
use TBCD\Webshop\Form\ContactAddressType;

class ContactAddressTypeTest extends TypeTestCase
{

    /**
     * @return void
     */
    public function testSubmitValidData(): void
    {
        $formData = [];
        $model = new ContactAddress();
        $form = $this->factory->create(ContactAddressType::class, $model);
        $expected = new ContactAddress();
        $form->submit($formData);
        $this->assertTrue($form->isSynchronized());
        $this->assertEquals($expected, $model);
    }

    /**
     * @return void
     */
    public function testFormView(): void
    {
        $formData = new ContactAddress();
        $view = $this->factory->create(ContactAddressType::class, $formData)->createView();
        $this->assertNotNull($view);
    }
}