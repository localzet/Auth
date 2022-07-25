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
 * Интерфейс личности
 */
interface IdentityInterface
{
    /**
     * Получить ID личности
     * @return string|null
     */
    public function getId(): ?string;

    /**
     * Обновить личность 
     * @return $this
     */
    public function refreshIdentity();
}
