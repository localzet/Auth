<?php

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
