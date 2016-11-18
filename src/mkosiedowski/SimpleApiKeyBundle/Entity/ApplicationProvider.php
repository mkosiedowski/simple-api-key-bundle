<?php

namespace mkosiedowski\SimpleApiKeyBundle\Entity;

use Doctrine\ORM\EntityManager;
use mkosiedowski\SimpleApiKeyBundle\Security\Authentication\Provider\AppProviderInterface;

class ApplicationProvider implements AppProviderInterface
{
    /** @var EntityManager */
    private $manager;

    /**
     * ApplicationProvider constructor.
     *
     * @param EntityManager $manager
     */
    public function __construct(EntityManager $manager)
    {
        $this->manager = $manager;
    }

    /** @inheritdoc */
    public function getAppByApiKey($apiKey)
    {
        return $this->manager->getRepository(Application::class)->findOneBy(['apiKey' => $apiKey]);
    }

    /** @inheritdoc */
    public function add($application)
    {
        $this->manager->persist($application);
        $this->manager->flush();
    }

    /** @inheritdoc */
    public function create($name)
    {
        return new Application($name);
    }
}
