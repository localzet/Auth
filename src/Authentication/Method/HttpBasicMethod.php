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
 * Метод базовой проверки HTTP 
 */
class HttpBasicMethod extends HttpAuthorizationMethod
{
    protected string $pattern = '/Basic\s+(.*)$/i';

    /**
     * @inheritDoc
     */
    protected function getAuthData(Request $request): ?string
    {
        if ($credentials = parent::getAuthData($request)) {
            $credentials = base64_decode($credentials);
            if (strpos($credentials, ':') !== false) {
                return $credentials;
            }
        }

        // http://admin:123456@127.0.0.0.0.0:8787/admin/auth/login

        return null;
    }
}
