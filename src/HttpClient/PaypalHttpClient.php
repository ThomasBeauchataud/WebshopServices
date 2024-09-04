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
use Symfony\Component\DependencyInjection\Attribute\AsAlias;
use Symfony\Component\DependencyInjection\Attribute\Target;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
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
    private readonly ParameterBagInterface $parameterBag;

    public function __construct(CacheInterface $cache, ParameterBagInterface $parameterBag, HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
        $this->cache = $cache;
        $this->parameterBag = $parameterBag;
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
                $client = $this->parameterBag->get('webshop_payment.paypal_client');
                $secret = $this->parameterBag->get('webshop_payment.paypal_secret');
                $url = "/v1/oauth2/token";
                $params = ['grant_type' => 'client_credentials'];
                $headers = ['Content-Type' => 'application/x-www-form-urlencoded'];
                $response = $this->httpClient->request(Request::METHOD_POST, $url, ['body' => $params, 'headers' => $headers, 'auth_basic' => [$client, $secret]])->toArray();
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