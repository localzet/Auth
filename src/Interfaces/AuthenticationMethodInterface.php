<?php

namespace localzet\Auth\Interfaces;

use localzet\FrameX\Http\Request;

/**
 * Интерфейс метода аутентификации
 */
interface AuthenticationMethodInterface
{
    /**
     * Аутентификация
     * @param Request $request
     * @return IdentityInterface|null
     */
    public function authenticate(Request $request): ?IdentityInterface;
}
