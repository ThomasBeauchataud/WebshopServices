<?php

/*
 * The file is part of the WoWUltimate project 
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Author Thomas Beauchataud
 * From 11/03/2022
 */

namespace TBCD\Webshop;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use TBCD\Webshop\HttpClient\PaypalHttpClient;
use TBCD\Webshop\Services\Payment\PaypalPaymentProvider;

class TBCDWebshopServicesBundle extends AbstractBundle
{

    /**
     * @inheritDoc
     */
    public function loadExtension(array $config, ContainerConfigurator $container, ContainerBuilder $builder): void
    {
        $container->services()
            ->load("TBCD\\Webshop\\", __DIR__ . "/../src/")
            ->autowire()
            ->autoconfigure();

        if ($builder->hasParameter('paypal.secret') && $builder->hasParameter('paypal.client')) {
            $container->services()
                ->get(PaypalPaymentProvider::class)
                ->bind(HttpClientInterface::class, $container->services()->get(PaypalHttpClient::class));
        }
    }
}