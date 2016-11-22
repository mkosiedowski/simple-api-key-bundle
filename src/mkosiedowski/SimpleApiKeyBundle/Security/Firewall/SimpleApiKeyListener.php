<?php

namespace mkosiedowski\SimpleApiKeyBundle\Security\Firewall;

use mkosiedowski\SimpleApiKeyBundle\Extractor\KeyExtractor;
use mkosiedowski\SimpleApiKeyBundle\Security\Authentication\Token\SimpleApiKeyToken;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\Security\Core\Authentication\AuthenticationManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\Firewall\ListenerInterface;

/**
 * @author Aaron Scherer <aequasi@gmail.com>
 */
class SimpleApiKeyListener implements ListenerInterface
{
    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * @var AuthenticationManagerInterface
     */
    private $authenticationManager;

    /**
     * @var KeyExtractor
     */
    private $keyExtractor;

    public function __construct(
        TokenStorageInterface $tokenStorage,
        AuthenticationManagerInterface $manager,
        KeyExtractor $keyExtractor
    ) {
        $this->tokenStorage = $tokenStorage;
        $this->authenticationManager = $manager;
        $this->keyExtractor = $keyExtractor;
    }

    /**
     * This interface must be implemented by firewall listeners.
     *
     * @param GetResponseEvent $event
     */
    public function handle(GetResponseEvent $event)
    {
        $request = $event->getRequest();

        if (!$this->keyExtractor->hasKey($request)) {
            $response = new Response();
            $response->setStatusCode(401);
            $response->setContent(json_encode(['error' => 'No API Key provided']));
            $event->setResponse($response);
        } else {
            try {
                $apiKey = $this->keyExtractor->extractKey($request);
                $token = new SimpleApiKeyToken();
                $token->setApiKey($apiKey);
                $this->authenticationManager->authenticate($token);
            } catch (AuthenticationException $failed) {
                $response = new Response();
                $response->setStatusCode(403);
                $response->setContent(json_encode(['error' => 'Invalid API Key']));
                $event->setResponse($response);
            }
        }
    }
}
