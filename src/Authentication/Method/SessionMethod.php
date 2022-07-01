<?php

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
