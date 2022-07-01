<?php

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
