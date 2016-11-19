<?php

namespace mkosiedowski\SimpleApiKeyBundle\Model;

/**
 * @author Maciej Kosiedowski <mkosied@gmail.com>
 */
interface ApplicationProviderInterface
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
