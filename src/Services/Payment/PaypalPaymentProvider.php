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

class PaypalPaymentProvider implements PaymentProviderInterface
{

    private readonly HttpClientInterface $httpClient;
    private readonly LoggerInterface $logger;

    public function __construct(HttpClientInterface $httpClient, LoggerInterface $logger)
    {
        $this->httpClient = $httpClient;
        $this->logger = $logger;
    }


    /**
     * @inheritDoc
     */
    public function getPayment(string $identifier): ?PaymentInterface
    {
        try {

            $url = "/v2/checkout/orders/$identifier";
            $response = $this->httpClient->request(Request::METHOD_GET, $url);
            $responseData = $response->toArray();
            $this->logger->info('Reception of a valid response : ' . json_encode($responseData));

            $payer = new Payer();
            $payer->setEmail($responseData['payer']['email_address'] ?? null);
            $payer->setFirstName($responseData['payer']['name']['given_name'] ?? null);
            $payer->setLastName($responseData['payer']['name']['surname'] ?? null);
            $payer->setPhone($responseData['payer']['phone']['phone_number'] ?? null);
            $payer->setAddressLine($responseData['payer']['address']['address_line_1'] ?? null);
            $payer->setPostalcode($responseData['payer']['address']['postal_code'] ?? null);

            $amount = 0;
            foreach ($responseData['purchase_units'] as $purchaseUnit) {
                if ($purchaseUnit['amount']['currency_code'] === 'EUR') {
                    $amount += $purchaseUnit['amount']['value'];
                } else {
                    $this->logger->warning('Unaccepted currency code ' . $purchaseUnit['amount']['currency_code']);
                }
            }

            return new PaypalPayment($payer, $amount, $responseData['status']);

        } catch (ExceptionInterface $e) {
            $this->logger->critical($e->getMessage());
            return null;
        }
    }
}