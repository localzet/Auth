<?php

/**
 * @version     1.0.0-dev
 * @package     FrameX (FX) Authentication Plugin
 * @link        https://localzet.gitbook.io
 * 
 * @author      localzet <creator@localzet.ru>
 * 
 * @copyright   Copyright (c) 2018-2020 Zorin Projects 
 * @copyright   Copyright (c) 2020-2022 NONA Team
 * 
 * @license     https://www.localzet.ru/license GNU GPLv3 License
 */

namespace localzet\Auth;

use localzet\Auth\Interfaces\GuardInterface;
use localzet\Auth\Middleware\SetAuthGuard;

class Auth
{
    const REQUEST_AUTH_MANAGER = 'auth_manager';

    /**
     * Получить экзепляр гварда по имени
     * 
     * @param string|null $name
     * @return GuardInterface|null
     */
    public static function guard(string $name = null): ?GuardInterface
    {
        if ($authManager = static::getAuthManager()) {
            $name = $name ?: request()->{SetAuthGuard::REQUEST_GUARD_NAME};
            return $authManager->guard($name);
        }
        return null;
    }

    /**
     * Возвращает менеджер гвардов
     * 
     * @return AuthManager|null
     */
    public static function getAuthManager(): ?AuthManager
    {
        $request = request();
        if (!$request) {
            return null;
        }
        if (!$request->{static::REQUEST_AUTH_MANAGER}) {
            $request->{static::REQUEST_AUTH_MANAGER} = new AuthManager();
        }
        return $request->{static::REQUEST_AUTH_MANAGER};
    }
}
