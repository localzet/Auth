<?php

namespace localzet\Auth\Authentication\Method;

/**
 * Параметры заголовка Http Bearer
 */
class HttpBearerMethod extends HttpAuthorizationMethod
{
    protected string $pattern = '/Bearer\s+(.*)$/i';
}
