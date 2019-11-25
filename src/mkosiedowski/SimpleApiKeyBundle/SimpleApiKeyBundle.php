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

        $extension = $container->getExtension('security');
        if ($extension instanceof SecurityExtension) {
            $extension->addSecurityListenerFactory(new SimpleApiKeyFactory());
        }
    }
}
