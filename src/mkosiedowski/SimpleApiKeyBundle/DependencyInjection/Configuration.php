<?php

namespace mkosiedowski\SimpleApiKeyBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('simple_api_key');

        $rootNode
            ->children()
                ->scalarNode('delivery')
                    ->defaultValue('query')
                    ->validate()
                        ->ifNotInArray(array('query', 'header'))
                        ->thenInvalid('Unknown authentication delivery type "%s".')
                     ->end()
                ->end()
                ->scalarNode('parameter_name')
                    ->defaultValue('apiKey')
                ->end()
                ->booleanNode('enabled')
                    ->defaultValue(true)
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
