<?php

namespace localzet\Auth\Authentication\FailureHandler;

use localzet\Auth\Exceptions\UnauthorizedException;
use localzet\Auth\Interfaces\AuthenticationFailureHandlerInterface;
use localzet\FrameX\Http\Request;
use localzet\FrameX\Http\Response;

/**
 * Исключение
 */
class ThrowExceptionHandler implements AuthenticationFailureHandlerInterface
{
    /**
     * @inheritDoc
     */
    public function handle(Request $request): Response
    {
        throw new UnauthorizedException();
    }
}
