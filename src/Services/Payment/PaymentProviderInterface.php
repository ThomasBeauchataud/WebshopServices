<?php

/*
 * Author Thomas Beauchataud
 * Since 14/02/2022
 */

namespace TBCD\Webshop\Services\Payment;

interface PaymentProviderInterface
{

    /**
     * @param string $identifier
     * @return PaymentInterface|null
     */
    public function getPayment(string $identifier): ?PaymentInterface;

}