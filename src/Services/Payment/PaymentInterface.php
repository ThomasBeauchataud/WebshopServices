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
 * From 01/11/2024
 */

namespace TBCD\Webshop\Services\Payment;

interface PaymentInterface
{

    /**
     * @return bool
     */
    public function isComplete(): bool;

}