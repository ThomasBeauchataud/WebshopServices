<?php

/*
 * Author Thomas Beauchataud
 * Since 02/02/2022
 */

namespace TBCD\Webshop\HttpClient;

use DateInterval;
use Exception;
use LogicException;
use Psr\Cache\CacheItemInterface;
use Psr\Cache\InvalidArgumentException;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpClient\HttpOptions;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;
use Symfony\Contracts\HttpClient\ResponseStreamInterface;

class PaypalHttpClient implements HttpClientInterface
{

    private const ACCESS_TOKEN_KEY = "access_token";
    private const EXPIRE_KEY = "expires_in";

    private HttpClientInterface $httpClient;
    private readonly CacheInterface $cache;
    private readonly string $paypalSecret;
    private readonly string $paypalClient;

    public function __construct(CacheInterface $cache, HttpClientInterface $httpClient, ParameterBagInterface $parameterBag)
    {
        $this->cache = $cache;
        $this->paypalSecret = $parameterBag->get('paypal.secret');
        $this->paypalClient = $parameterBag->get('paypal.client');

        if ($parameterBag->has('paypal.hostname')) {
            $paypalHostname = $parameterBag->get('paypal.hostname');
        } else {
            $paypalHostname = $parameterBag->get('kernel.environment') === 'prod' ? 'https://api-m.paypal.com' : 'https://api-m.sandbox.paypal.com';
        }

        $this->httpClient = $httpClient->withOptions((new HttpOptions())->setBaseUri($paypalHostname)->toArray());
    }


    /**
     * @inheritDoc
     */
    public function request(string $method, string $url, array $options = []): ResponseInterface
    {
        $options['auth_bearer'] = $this->getAccessToken();
        $options['headers']['Content-Type'] = 'application/json';
        return $this->httpClient->request($method, $url, $options);
    }

    /**
     * @return string
     */
    private function getAccessToken(): string
    {
        try {

            return $this->cache->get('webshop_payment.paypal.access_token', function (CacheItemInterface $cacheItem) {
                $url = "/v1/oauth2/token";
                $params = ['grant_type' => 'client_credentials'];
                $headers = ['Content-Type' => 'application/x-www-form-urlencoded'];
                $response = $this->httpClient->request(Request::METHOD_POST, $url, ['body' => $params, 'headers' => $headers, 'auth_basic' => [$this->paypalClient, $this->paypalSecret]])->toArray();
                $cacheItem->expiresAfter(new DateInterval('PT' . $response[self::EXPIRE_KEY] . 'S'));
                return $response[self::ACCESS_TOKEN_KEY];
            });

        } catch (InvalidArgumentException $e) {
            return new Exception($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * @inheritDoc
     */
    public function stream(iterable|ResponseInterface $responses, float $timeout = null): ResponseStreamInterface
    {
        throw new LogicException('The stream method is not available with ' . self::class);
    }

    /**
     * @inheritDoc
     */
    public function withOptions(array $options): static
    {
        $clone = clone $this;
        $clone->httpClient = $this->httpClient->withOptions($options);
        return $clone;
    }
}