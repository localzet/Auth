<?php

namespace localzet\Auth\Interfaces;

/**
 * Интерфейс репозитория личностей
 */
interface IdentityRepositoryInterface
{
    /**
     * Поиск личности на основе токена
     * @param string $token token или id
     * @param string|null $type Тип токена
     * @return IdentityInterface|null
     */
    public function findIdentity(string $token, string $type = null): ?IdentityInterface;
}
