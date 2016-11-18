<?php

namespace mkosiedowski\SimpleApiKeyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="applicationKeys")
 */
class Application extends \mkosiedowski\SimpleApiKeyBundle\Model\Application
{
    /**
     * @ORM\Id
     * @ORM\Column(name="apiKey", type="string", length=255, nullable=false)
     */
    protected $apiKey;

    /**
     * @ORM\Column(name="applicationName", type="string", length=255, nullable=false)
     */
    protected $applicationName;
}
