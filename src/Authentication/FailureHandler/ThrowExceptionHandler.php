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

use localzet\Auth\Exceptions\UnauthorizedException;
use localzet\Auth\Interfaces\AuthenticationFailureHandlerInterface;
use localzet\FrameX\Http\Request;
use localzet\FrameX\Http\Response;

/**
 * Исключение
 */
class ThrowExceptionHandler implements AuthenticationFailureHandlerInterface
{
    protected string $message;
    protected string $code;

    public function __construct(string $message = 'Ошибка аутентификации', int $code = 401)
    {
        $this->message = $message;
        $this->code = $code;
    }

    /**
     * @inheritDoc
     */
    public function handle(Request $request): Response
    {
        throw new UnauthorizedException($this->message, $this->code);
    }
}
