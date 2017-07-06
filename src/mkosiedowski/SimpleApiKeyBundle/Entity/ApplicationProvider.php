<?php

namespace mkosiedowski\SimpleApiKeyBundle\Entity;

use Doctrine\ORM\EntityManager;
use mkosiedowski\SimpleApiKeyBundle\Model\ApplicationProviderInterface;

class ApplicationProvider implements ApplicationProviderInterface
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
    public function getAll()
    {
        return $this->manager->getRepository(Application::class)->findAll();
    }

    /** @inheritdoc */
    public function create($name)
    {
        return new Application($name);
    }
}
