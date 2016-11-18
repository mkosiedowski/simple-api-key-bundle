<?php

namespace mkosiedowski\SimpleApiKeyBundle\Model;

use mkosiedowski\SimpleApiKeyBundle\Util\ApiKeyGenerator;

/**
 * @author Maciej Kosiedowski <mkosied@gmail.com>
 */
class Application
{
    protected $apiKey;

    protected $applicationName;

    public function __construct($applicationName)
    {
        $this->applicationName = $applicationName;
        $this->apiKey = ApiKeyGenerator::generate();
    }

    /**
     * @return string
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    public function regenerateKey()
    {
        $this->apiKey = ApiKeyGenerator::generate();
    }

    /**
     * @return mixed
     */
    public function getApplicationName()
    {
        return $this->applicationName;
    }

}
