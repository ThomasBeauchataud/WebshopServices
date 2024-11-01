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
 * From 01/09/2024
 */

namespace TBCD\Webshop\Services\Payment\Paypal\Model;

use TBCD\Webshop\Services\Payment\PaymentInterface;

class PaypalPayment implements PaymentInterface
{

    private string $id;
    private string $status;
    private float $amount;

    /**
     * @param string $id
     * @param string $status
     * @param float $amount
     */
    public function __construct(string $id, string $status, float $amount)
    {
        $this->id = $id;
        $this->status = $status;
        $this->amount = $amount;
    }


    public function getId(): string
    {
        return $this->id;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @inheritDoc
     */
    public function isComplete(): bool
    {
        return $this->status === "COMPLETED";
    }
}