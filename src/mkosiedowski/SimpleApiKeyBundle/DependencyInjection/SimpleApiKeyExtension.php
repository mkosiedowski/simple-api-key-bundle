<?php

namespace mkosiedowski\SimpleApiKeyBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * @author Maciej Kosiedowski <mkosied@gmail.com>
 * @author Aaron Scherer <aequasi@gmail.com>
 */
class SimpleApiKeyExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader(
            $container,
            new FileLocator(__DIR__.'/../Resources/config')
        );
        $loader->load('services.yml');

        $this->defineKeyExtractor($config, $container);
        $container->setParameter('mkosiedowski.simple_api_key.enabled', $config['enabled']);
    }

    private function defineKeyExtractor(array $config, ContainerBuilder $container)
    {
        $container->setParameter('mkosiedowski.simple_api_key.parameter_name', $config['parameter_name']);
        $container->setAlias('mkosiedowski.simple_api_key.extractor', 'mkosiedowski.simple_api_key.extractor.'.$config['delivery']);
    }
}

