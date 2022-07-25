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
 * Интерфейс гварда
 */
interface GuardInterface
{
    /**
     * Получить метод авторизации
     * @return AuthenticationMethodInterface
     */
    public function getAuthenticationMethod(): AuthenticationMethodInterface;

    /**
     * Получить неудачный процесс сертификации
     * @return AuthenticationFailureHandlerInterface
     */
    public function getAuthenticationFailedHandler(): AuthenticationFailureHandlerInterface;

    /**
     * Авторизоваться
     * @param IdentityInterface $identity
     */
    public function login(IdentityInterface $identity): void;

    /**
     * Выйти
     */
    public function logout(): void;

    /**
     * Входить в систему
     * @return bool
     */
    public function isGuest(): bool;

    /**
     * Пользователь в системе
     * @param bool $refresh
     * @return IdentityInterface|null
     */
    public function getUser(bool $refresh = false): ?IdentityInterface;

    /**
     * ID пользователя в системе
     * @return string|null
     */
    public function getId(): ?string;
}
