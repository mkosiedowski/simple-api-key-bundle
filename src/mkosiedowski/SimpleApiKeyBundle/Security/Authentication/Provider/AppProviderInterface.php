<?php

namespace mkosiedowski\SimpleApiKeyBundle\Security\Authentication\Provider;

use mkosiedowski\SimpleApiKeyBundle\Model\Application;

interface AppProviderInterface
{
    /**
     * @param string $apiKey
     * @return Application
     */
    public function getAppByApiKey($apiKey);

    /**
     * @param Application $application
     */
    public function add($application);

    /**
     * @param string $name
     * @return Application
     */
    public function create($name);
}
