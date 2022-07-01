<?php

namespace localzet\Auth\Interfaces;

use localzet\FrameX\Http\Request;
use localzet\FrameX\Http\Response;

/**
 * Интерфейс ошибки аутентификации
 */
interface AuthenticationFailureHandlerInterface
{
    /**
     * Ответ на ошибку аутентификации
     * @param Request $request
     * @return Response
     */
    public function handle(Request $request): Response;
}
