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

namespace localzet\Auth\Middleware;

use localzet\Auth\Auth;
use localzet\Auth\Interfaces\GuardInterface;
use localzet\Auth\Interfaces\IdentityInterface;
use localzet\FrameX\Http\Request;
use localzet\FrameX\Http\Response;
use localzet\FrameX\MiddlewareInterface;

/**
 * Middleware авторизации
 */
class Authentication implements MiddlewareInterface
{
    /**
     * @inheritDoc
     */
    public function process(Request $request, callable $handler): Response
    {
        // Получение имени гварда из SetAuthGuard
        $guard = $this->getGuard();
        // Получение личности
        $identity = $guard->getAuthenticationMethod()->authenticate($request);

        // Если есть токен и удалось получить личность
        if ($identity instanceof IdentityInterface) {
            // Запускаем процедуру входа
            $guard->login($identity);
            return $handler($request);
        }

        // Ну а если токена нет - проверяем исключительные пути
        if ($this->isOptionalRoute($request)) {
            return $handler($request);
        }

        return $guard->getAuthenticationFailedHandler()->handle($request);
    }

    /**
     * Получение гварда
     * @return GuardInterface
     */
    protected function getGuard(): GuardInterface
    {
        // Гвард по дефолту
        return Auth::guard();
    }

    /**
     * Проверка исключительного пути
     * @param Request $request
     * @return bool
     */
    protected function isOptionalRoute(Request $request): bool
    {
        $path = $request->path();
        if (in_array($path, $this->optionalRoutes())) {
            return true;
        }

        return false;
    }

    /**
     * Исключительные пути
     * @return array
     */
    protected function optionalRoutes(): array
    {
        return [];
    }
}
