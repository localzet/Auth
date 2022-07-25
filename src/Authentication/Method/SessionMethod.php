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

namespace localzet\Auth\Authentication\Method;

use localzet\Auth\Guard\Guard;
use localzet\FrameX\Http\Request;

/**
 * Параметры сессии
 */
class SessionMethod extends BaseMethod
{
    protected string $name = Guard::SESSION_AUTH_ID;

    /**
     * @inheritDoc
     */
    protected function getAuthData(Request $request): ?string
    {
        return $request->session()->get($this->name);
    }
}
