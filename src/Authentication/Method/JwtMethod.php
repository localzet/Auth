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
            return JwtToken::getExtendVal('user_id');
        } catch (JwtTokenException $e) {
            if ($this->throwException) {
                throw $e;
            }
            return null;
        }
    }

    public function getToken(Request $request): ?string
    {
        try {
            return JwtToken::getToken();
        } catch (JwtTokenException $e) {
            if ($this->throwException) {
                throw $e;
            }
            return null;
        }
    }
}
