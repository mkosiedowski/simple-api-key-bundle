<?php

namespace mkosiedowski\SimpleApiKeyBundle\Security\Authentication\Provider;

use Symfony\Component\Security\Core\Authentication\Provider\AuthenticationProviderInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use mkosiedowski\SimpleApiKeyBundle\Security\Authentication\Token\SimpleApiKeyToken;
use mkosiedowski\SimpleApiKeyBundle\Security\Authentication\Provider\ApiKeyUserProviderInterface;

/**
 * @author Maciej Kosiedowski <mkosied@gmail.com>
 */
class SimpleApiKeyProvider implements AuthenticationProviderInterface
{
    /**
     * @var AppProviderInterface
     */
    protected $applicationProvider;

    public function __construct(AppProviderInterface $appProvider)
    {
        $this->applicationProvider = $appProvider;
    }

    /**
     * Attempts to authenticate a TokenInterface object.
     *
     * @param TokenInterface $token The TokenInterface instance to authenticate
     *
     * @return TokenInterface An authenticated TokenInterface instance, never null
     *
     * @throws AuthenticationException if the authentication fails
     */
    public function authenticate(TokenInterface $token)
    {
        $application = $this->applicationProvider->getAppByApiKey($token->getCredentials());

        if ($application) {
            $authenticatedToken = new SimpleApiKeyToken();
            $authenticatedToken->setAuthenticated(true);

            return $authenticatedToken;
        }

        throw new AuthenticationException("The API Key authentication failed.");

    }

    /**
     * Checks whether this provider supports the given token.
     *
     * @param TokenInterface $token A TokenInterface instance
     *
     * @return Boolean true if the implementation supports the Token, false otherwise
     */
    public function supports(TokenInterface $token)
    {
        return $token instanceof SimpleApiKeyToken;
    }
}
