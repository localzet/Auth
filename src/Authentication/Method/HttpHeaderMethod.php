<?php

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
