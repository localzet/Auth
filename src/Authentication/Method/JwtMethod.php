<?php

namespace localzet\Auth\Authentication\Method;

use InvalidArgumentException;
use localzet\Auth\Interfaces\IdentityRepositoryInterface;
use localzet\JWT\Exception\JwtTokenException;
use localzet\JWT\JwtToken;
use localzet\FrameX\Http\Request;

/**
 * localzet\JWT
 * @link https://github.com/localzet/JWT
 */
class JwtMethod extends BaseMethod
{
    protected bool $throwException = false;

    public function __construct(IdentityRepositoryInterface $identity, array $config = [])
    {
        parent::__construct($identity, $config);

        if (!class_exists('localzet\JWT\JwtToken')) {
            throw new InvalidArgumentException('composer require localzet/jwt');
        }
    }

    /**
     * @inheritDoc
     */
    protected function getAuthData(Request $request): ?string
    {
        try {
            // Возвращает id пользователя из токена в хэдере
            return JwtToken::getTokenExtend();
        } catch (JwtTokenException $e) {
            if ($this->throwException) {
                throw $e;
            }
            return null;
        }
    }
}
