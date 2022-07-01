<?php

namespace localzet\Auth\Middleware;

use localzet\FrameX\Http\Request;
use localzet\FrameX\Http\Response;
use localzet\FrameX\MiddlewareInterface;

/**
 * Установка имени гварда в $request
 */
class SetAuthGuard implements MiddlewareInterface
{
    public const REQUEST_GUARD_NAME = 'auth_current_guard_name';

    protected string $guardName;

    public function __construct(string $guardName = null)
    {
        $this->guardName = $guardName;
    }

    /**
     * @inheritDoc
     */
    public function process(Request $request, callable $handler): Response
    {
        if ($this->guardName) {
            $request->{static::REQUEST_GUARD_NAME} = $this->guardName;
        }

        return $handler($request);
    }
}
