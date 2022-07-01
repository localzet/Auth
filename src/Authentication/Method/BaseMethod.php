<?php

namespace localzet\Auth\Authentication\Method;

use localzet\Auth\Interfaces\AuthenticationMethodInterface;
use localzet\Auth\Interfaces\IdentityInterface;
use localzet\Auth\Interfaces\IdentityRepositoryInterface;
use localzet\FrameX\Http\Request;

abstract class BaseMethod implements AuthenticationMethodInterface
{
    protected IdentityRepositoryInterface $identityRepository;
    protected ?string $tokenType = null;

    public function __construct(IdentityRepositoryInterface $identityRepository, array $config = [])
    {
        foreach ($config as $key => $value) {
            $this->{$key} = $value;
        }
        $this->identityRepository = $identityRepository;
    }

    /**
     * @inheritDoc
     */
    public function authenticate(Request $request): ?IdentityInterface
    {
        if ($token = $this->getAuthData($request)) {
            // Возвращает личность по id
            return $this->identityRepository->findIdentity($token, $this->tokenType);
        }

        return null;
    }

    /**
     * Данные из токена
     * @param Request $request
     * @return string|null
     */
    abstract protected function getAuthData(Request $request): ?string;
}
