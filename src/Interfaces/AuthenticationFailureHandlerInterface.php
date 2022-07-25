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

use localzet\FrameX\Http\Request;
use localzet\FrameX\Http\Response;

/**
 * Интерфейс ошибки аутентификации
 */
interface AuthenticationFailureHandlerInterface
{
    /**
     * Ответ на ошибку аутентификации
     * @param Request $request
     * @return Response
     */
    public function handle(Request $request): Response;
}
