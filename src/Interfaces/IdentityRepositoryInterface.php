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

namespace localzet\Auth\Interfaces;

/**
 * Интерфейс репозитория личностей
 */
interface IdentityRepositoryInterface
{
    /**
     * Поиск личности на основе токена
     * @param string $user_id token или id
     * @param string|null $type Тип токена
     * @return IdentityInterface|null
     */
    public function findIdentity($user_id): ?IdentityInterface;
}
