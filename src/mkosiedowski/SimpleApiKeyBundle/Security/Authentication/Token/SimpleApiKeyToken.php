<?php

namespace mkosiedowski\SimpleApiKeyBundle\Security\Authentication\Token;

use mkosiedowski\SimpleApiKeyBundle\Model\Application;
use Symfony\Component\Security\Core\Authentication\Token\AbstractToken;

/**
 * @author Maciej Kosiedowski <mkosied@gmail.com>
 */
class SimpleApiKeyToken extends AbstractToken
{
    /** @var string */
    protected $apiKey;

    /** @var Application */
    protected $application;

    /**
     * @return string
     */
    public function getCredentials()
    {
        return $this->apiKey;
    }

    /**
     * @param string $apiKey
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * @return string
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * @return Application
     */
    public function getApplication()
    {
        return $this->application;
    }

    /**
     * @param Application $application
     */
    public function setApplication($application)
    {
        $this->application = $application;
    }
}
