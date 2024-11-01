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

namespace TBCD\Webshop\Services\Payment\Paypal\Model;

use TBCD\Webshop\Entity\ContactAddress;

class PaypalOrder
{

    private string $id;
    private ContactAddress $payer;
    private string $status;
    private array $payments;

    /**
     * @param string $id
     * @param ContactAddress $payer
     * @param string $status
     * @param array $payments
     */
    public function __construct(string $id, ContactAddress $payer, string $status, array $payments)
    {
        $this->id = $id;
        $this->payer = $payer;
        $this->status = $status;
        $this->payments = $payments;
    }


    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return ContactAddress
     */
    public function getPayer(): ContactAddress
    {
        return $this->payer;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return PaypalPayment[]
     */
    public function getPayments(): array
    {
        return $this->payments;
    }
}