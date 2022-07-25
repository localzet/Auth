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
 * Параметры запроса
 */
class RequestMethod extends BaseMethod
{
    protected string $name = 'access-token';
    protected string $requestMethod = 'input';

    /**
     * @inheritDoc
     */
    protected function getAuthData(Request $request): ?string
    {
        return $request->{$this->requestMethod}($this->name);
    }
}
