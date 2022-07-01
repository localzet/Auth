<?php

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
