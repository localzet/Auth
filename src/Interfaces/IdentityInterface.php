<?php

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
