<?php

namespace localzet\Auth\Guard;

use localzet\Auth\Authentication\Method\SessionMethod;
use localzet\Auth\Interfaces\AuthenticationFailureHandlerInterface;
use localzet\Auth\Interfaces\AuthenticationMethodInterface;
use localzet\Auth\Interfaces\GuardInterface;
use localzet\Auth\Interfaces\IdentityInterface;
use localzet\Auth\Interfaces\IdentityRepositoryInterface;

class Guard implements GuardInterface
{
    public const SESSION_AUTH_ID = '__auth_id';

    protected array $config = [
        'identityRepository' => null,
        'authenticationMethod' => null,
        'authenticationFailureHandler' => null,
        'sessionEnable' => false,
    ];

    public function __construct(array $config = [])
    {
        $this->config = array_merge($this->config, $config);
    }



    /**
     * @var IdentityRepositoryInterface|null
     */
    protected ?IdentityRepositoryInterface $identityRepository = null;

    /**
     * Получение репозитория личностей
     * 
     * @return IdentityRepositoryInterface
     */
    protected function getIdentityRepository(): IdentityRepositoryInterface
    {
        if ($this->identityRepository === null) {
            $this->identityRepository = call_user_func($this->config['identityRepository']);
        }
        return $this->identityRepository;
    }



    /**
     * @var AuthenticationMethodInterface|null
     */
    protected ?AuthenticationMethodInterface $authenticationMethod = null;

    /**
     * @inheritDoc
     */
    public function getAuthenticationMethod(): AuthenticationMethodInterface
    {
        if ($this->authenticationMethod === null) {
            $this->authenticationMethod = call_user_func($this->config['authenticationMethod'], $this->getIdentityRepository());
        }
        return $this->authenticationMethod;
    }



    /**
     * @var AuthenticationFailureHandlerInterface|null
     */
    protected ?AuthenticationFailureHandlerInterface $authenticationFailureHandler = null;

    /**
     * @inheritDoc
     */
    public function getAuthenticationFailedHandler(): AuthenticationFailureHandlerInterface
    {
        if ($this->authenticationFailureHandler === null) {
            $this->authenticationFailureHandler = call_user_func($this->config['authenticationFailureHandler']);
        }
        return $this->authenticationFailureHandler;
    }



    /**
     * @var IdentityInterface|null
     */
    protected ?IdentityInterface $identity = null;

    /**
     * @inheritDoc
     */
    public function login(IdentityInterface $identity): void
    {
        $this->identity = $identity;

        // В режиме сеанса вам нужно сохранить сеанс
        $authenticationMethod = $this->getAuthenticationMethod();
        if ($authenticationMethod instanceof SessionMethod || $this->config['sessionEnable']) {
            $session = request()->session();
            $session->set(static::SESSION_AUTH_ID, $this->getId());
        }
    }



    /**
     * @inheritDoc
     */
    public function logout(): void
    {
        if ($this->isGuest()) {
            return;
        }

        $this->identity = null;

        // Удалить сеанс в режиме сеанса
        $authenticationMethod = $this->getAuthenticationMethod();
        if ($authenticationMethod instanceof SessionMethod || $this->config['sessionEnable']) {
            $session = request()->session();
            $session->delete(static::SESSION_AUTH_ID);
        }
    }



    /**
     * @inheritDoc
     */
    public function isGuest(): bool
    {
        return $this->identity === null;
    }



    /**
     * @inheritDoc
     */
    public function getUser(bool $refresh = false): ?IdentityInterface
    {
        if (!$this->identity instanceof IdentityInterface) {
            return null;
        }
        if ($refresh) {
            $this->identity = $this->identity->refreshIdentity();
        }
        return $this->identity;
    }



    /**
     * @inheritDoc
     */
    public function getId(): ?string
    {
        return $this->identity instanceof IdentityInterface ? $this->identity->getId() : null;
    }
}
