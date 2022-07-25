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

use localzet\Auth\Interfaces\AuthenticationMethodInterface;
use localzet\Auth\Interfaces\IdentityInterface;
use localzet\Auth\Interfaces\IdentityRepositoryInterface;
use localzet\FrameX\Http\Request;

abstract class BaseMethod implements AuthenticationMethodInterface
{
    protected IdentityRepositoryInterface $identityRepository;

    public function __construct(IdentityRepositoryInterface $identityRepository, array $config = [])
    {
        foreach ($config as $key => $value) {
            $this->{$key} = $value;
        }
        $this->identityRepository = $identityRepository;
    }

    /**
     * @inheritDoc
     */
    public function authenticate(Request $request): ?IdentityInterface
    {

        if ($user_id = $this->getAuthData($request)) {

            // Возвращает личность по id
            return $this->identityRepository->findIdentity($user_id);
        }

        return null;
    }

    /**
     * Данные из токена
     * @param Request $request
     * @return string|null
     */
    abstract protected function getAuthData(Request $request): ?string;
}
