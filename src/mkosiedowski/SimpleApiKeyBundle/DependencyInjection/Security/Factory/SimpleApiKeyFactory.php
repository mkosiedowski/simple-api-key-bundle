<?php

namespace mkosiedowski\SimpleApiKeyBundle\DependencyInjection\Security\Factory;

use Symfony\Bundle\SecurityBundle\DependencyInjection\Security\Factory\SecurityFactoryInterface;
use Symfony\Component\Config\Definition\Builder\NodeDefinition;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\ChildDefinition;

/**
 * @author Maciej Kosiedowski <mkosied@gmail.com>
 * @author Aaron Scherer <aequasi@gmail.com>
 */
class SimpleApiKeyFactory implements SecurityFactoryInterface
{
    public function create(ContainerBuilder $container, $id, $config, $userProvider, $defaultEntryPoint)
    {
        $providerId = 'security.authentication.provider.simple_api_key.' . $id;
        $container->setDefinition($providerId, new ChildDefinition('mkosiedowski.simple_api_key.provider.api_key'));

        $listenerId = 'security.authentication.listener.simple_api_key.' . $id;
        $container->setDefinition($listenerId, new ChildDefinition('mkosiedowski.simple_api_key.listener.api_key'));

        return array($providerId, $listenerId, $defaultEntryPoint);
    }

    public function getPosition()
    {
        return 'pre_auth';
    }

    public function getKey()
    {
        return 'simple_api_key';
    }

    public function addConfiguration(NodeDefinition $builder)
    {
    }
}
