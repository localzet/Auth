<?php

namespace localzet\Auth\Authentication\FailureHandler;

use localzet\Auth\Interfaces\AuthenticationFailureHandlerInterface;
use localzet\FrameX\Http\Request;
use localzet\FrameX\Http\Response;

/**
 * Перенаправление процесса
 */
class RedirectHandler implements AuthenticationFailureHandlerInterface
{
    protected string $redirectUrl;

    public function __construct(string $redirectUrl)
    {
        $this->redirectUrl = $redirectUrl;
    }

    /**
     * @inheritDoc
     */
    public function handle(Request $request): Response
    {
        return (new Response())
            ->withStatus(302)
            ->withHeader('Location', $this->redirectUrl);
    }
}
