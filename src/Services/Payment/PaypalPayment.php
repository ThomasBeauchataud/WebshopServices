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

namespace TBCD\Webshop\Services\Payment;

class PaypalPayment implements PaymentInterface
{

    private Payer $payer;
    private float $amount;
    private string $status;

    public function __construct(Payer $payer, float $amount, string $status)
    {
        $this->payer = $payer;
        $this->amount = $amount;
        $this->status = $status;
    }


    /**
     * @inheritDoc
     */
    public function getPayer(): Payer
    {
        return $this->payer;
    }

    /**
     * @inheritDoc
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @inheritDoc
     */
    public function isComplete(): bool
    {
        return $this->status === 'COMPLETED';
    }
}