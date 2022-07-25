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

use localzet\FrameX\Http\Request;

/**
 * Параметры заголовков
 */
class HttpHeaderMethod extends BaseMethod
{
    protected string $name = 'X-Api-Key';

    /**
     * @inheritDoc
     */
    protected function getAuthData(Request $request): ?string
    {
        return $request->header($this->name);
    }
}
