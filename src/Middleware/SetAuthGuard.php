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

use localzet\FrameX\Http\Request;
use localzet\FrameX\Http\Response;
use localzet\FrameX\MiddlewareInterface;

/**
 * Установка имени гварда в $request
 */
class SetAuthGuard implements MiddlewareInterface
{
    public const REQUEST_GUARD_NAME = 'auth_current_guard_name';

    protected string $guardName;

    public function __construct(string $guardName = null)
    {
        $this->guardName = $guardName;
    }

    /**
     * @inheritDoc
     */
    public function process(Request $request, callable $handler): Response
    {
        if ($this->guardName) {
            $request->{static::REQUEST_GUARD_NAME} = $this->guardName;
        }

        return $handler($request);
    }
}
