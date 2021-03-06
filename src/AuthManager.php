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

namespace localzet\Auth;

use InvalidArgumentException;
use localzet\Auth\Guard\Guard;
use localzet\Auth\Interfaces\GuardInterface;

class AuthManager
{
    protected array $guards = [];

    /**
     * Получить экзепляр гварда по имени
     * 
     * @param string|null $name
     * @return GuardInterface
     */
    public function guard(string $name = null): GuardInterface
    {
        $name = $name ?? config('plugin.framex.auth.auth.default');
        if (!isset($this->guards[$name])) {
            $this->guards[$name] = $this->createGuard($this->getConfig($name));
        }

        return $this->guards[$name];
    }

    /**
     * Сведения о гварде
     * 
     * @param string $name
     * @return array
     */
    protected function getConfig(string $name): array
    {
        $key = "plugin.framex.auth.auth.guards.{$name}";
        $config = config($key);
        if (!$config) {
            throw new InvalidArgumentException($key . ' не существует');
        }
        return $config;
    }

    /**
     * Создание экземпляра класса гварда
     * 
     * @param array $config
     * @return GuardInterface
     */
    protected function createGuard(array $config): GuardInterface
    {
        $guardClass = $config['class'] ?? Guard::class;
        $guard = new $guardClass($config);
        if (!$guard instanceof GuardInterface) {
            throw new InvalidArgumentException('Класс guard должен быть реализацией GuardInterface');
        }
        return $guard;
    }
}
