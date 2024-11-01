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

class PaypalOrder
{

    private string $id;
    private PaypalPayer $payer;
    private string $status;
    private array $payments;

    /**
     * @param string $id
     * @param PaypalPayer $payer
     * @param string $status
     * @param array $payments
     */
    public function __construct(string $id, PaypalPayer $payer, string $status, array $payments)
    {
        $this->id = $id;
        $this->payer = $payer;
        $this->status = $status;
        $this->payments = $payments;
    }


    public function getId(): string
    {
        return $this->id;
    }

    public function getPayer(): PaypalPayer
    {
        return $this->payer;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getPayments(): array
    {
        return $this->payments;
    }
}