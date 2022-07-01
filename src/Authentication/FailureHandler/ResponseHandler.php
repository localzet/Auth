<?php

namespace localzet\Auth\Authentication\FailureHandler;

use localzet\Auth\Interfaces\AuthenticationFailureHandlerInterface;
use localzet\FrameX\Http\Request;
use localzet\FrameX\Http\Response;

/**
 * Response процесс контента
 */
class ResponseHandler implements AuthenticationFailureHandlerInterface
{
    /**
     * @inheritDoc
     */
    public function handle(Request $request): Response
    {
        return (new Response())->withStatus(401);
    }
}
