<?php

namespace mkosiedowski\SimpleApiKeyBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Bundle\SecurityBundle\DependencyInjection\SecurityExtension;
use mkosiedowski\SimpleApiKeyBundle\DependencyInjection\Security\Factory\SimpleApiKeyFactory;

/**
 * @author Maciej Kosiedowski <mkosied@gmail.com>
 */
class SimpleApiKeyBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        /** @var SecurityExtension $extension */
        $extension = $container->getExtension('security');
        $extension->addSecurityListenerFactory(new SimpleApiKeyFactory());
    }
}
