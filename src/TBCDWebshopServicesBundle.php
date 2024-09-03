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

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

class TBCDWebshopServicesBundle extends AbstractBundle
{

    /**
     * @inheritDoc
     */
    public function loadExtension(array $config, ContainerConfigurator $container, ContainerBuilder $builder): void
    {
        $loader = new YamlFileLoader($builder, new FileLocator(__DIR__ . '/Resources/config'));
        $loader->load('services.yaml');
    }
}