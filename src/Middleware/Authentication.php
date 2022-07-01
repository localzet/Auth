<?php

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
