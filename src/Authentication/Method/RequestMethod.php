<?php

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
