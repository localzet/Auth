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
            ->withHeaders(config('server.http.headers'))
            ->withHeader('Location', $this->redirectUrl);
    }
}
