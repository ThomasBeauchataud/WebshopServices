<?php

/*
 * Author Thomas Beauchataud
 * Since 14/02/2022
 */

namespace TBCD\Webshop\Services\Payment;

use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\HttpClient\Exception\ExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class PaypalPaymentProvider
{

    private readonly HttpClientInterface $httpClient;
    private readonly LoggerInterface $logger;

    public function __construct(HttpClientInterface $httpClient, LoggerInterface $logger)
    {
        $this->httpClient = $httpClient;
        $this->logger = $logger;
    }


    /**
     * @param string $identifier
     * @return PaypalOrder|null
     */
    public function getOrder(string $identifier): ?PaypalOrder
    {
        try {

            $url = "/v2/checkout/orders/$identifier";
            $response = $this->httpClient->request(Request::METHOD_GET, $url);
            $responseData = $response->toArray();
            $this->logger->debug('Reception of a valid response : ' . json_encode($responseData));

            $payer = new Payer();
            $payer->setEmail($responseData['payer']['email_address'] ?? null);
            $payer->setFirstName($responseData['payer']['name']['given_name'] ?? null);
            $payer->setLastName($responseData['payer']['name']['surname'] ?? null);
            $payer->setPhone($responseData['payer']['phone']['phone_number'] ?? null);
            $payer->setAddressLine($responseData['payer']['address']['address_line_1'] ?? null);
            $payer->setZipCode($responseData['payer']['address']['postal_code'] ?? null);

            $paypalPayments = [];
            foreach ($responseData['purchase_units'] as $purchaseUnit) {
                foreach ($purchaseUnit['payments'] as $payment) {
                    foreach ($payment['captures'] as $capture) {
                        if ($capture['amount']['currency_code'] !== 'EUR') {
                            $paypalPayments[] = new PaypalPayment($capture['id'], $capture['status'], $capture['amount']['value']);
                        } else {
                            $this->logger->warning('Unaccepted currency code ' . $purchaseUnit['amount']['currency_code']);
                        }
                    }
                }

            }

            return new PaypalOrder($responseData['id'], $payer, $responseData['status'], $paypalPayments);

        } catch (ExceptionInterface $e) {
            $this->logger->critical($e->getMessage());
            return null;
        }
    }
}