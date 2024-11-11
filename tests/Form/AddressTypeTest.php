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
use TBCD\Webshop\Form\AddressType;

class AddressTypeTest extends TypeTestCase
{

    /**
     * @return void
     */
    public function testSubmit(): void
    {
        $formData = [];
        $model = new Address();
        $form = $this->factory->create(AddressType::class, $model);
        $expected = new Address();
        $form->submit($formData);
        $this->assertTrue($form->isSynchronized());
        $this->assertEquals($expected, $model);
    }

    /**
     * @return void
     */
    public function testView(): void
    {
        $formData = new Address();
        $view = $this->factory->create(AddressType::class, $formData)->createView();
        $this->assertNotNull($view);
    }

    /**
     * @return void
     */
    public function testViewCountiesOption(): void
    {
        $formOptions = ['countries' => ['FR' => 'France']];
        $formData = new Address();
        $view = $this->factory->create(AddressType::class, $formData, $formOptions)->createView();
        $this->assertNotNull($view);
    }
}