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

class HttpAuthorizationMethod extends BaseMethod
{
    protected string $name = 'Authorization';
    protected string $pattern = '/(.*)/';

    /**
     * @inheritDoc
     */
    protected function getAuthData(Request $request): ?string
    {
        $authorization = $request->header($this->name);
        if (preg_match($this->pattern, $authorization, $matches)) {
            return $matches[1];
        }

        return null;
    }
}
