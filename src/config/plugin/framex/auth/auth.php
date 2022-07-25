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

// identityRepository
use app\repository\Users;

use localzet\Auth\Interfaces\IdentityRepositoryInterface;

// authenticationMethod
use localzet\Auth\Authentication\Method\HttpAuthorizationMethod;
use localzet\Auth\Authentication\Method\HttpBasicMethod;
use localzet\Auth\Authentication\Method\HttpBearerMethod;
use localzet\Auth\Authentication\Method\HttpHeaderMethod;
use localzet\Auth\Authentication\Method\JwtMethod;
use localzet\Auth\Authentication\Method\RequestMethod;
use localzet\Auth\Authentication\Method\SessionMethod;

// authenticationFailureHandler
use localzet\Auth\Authentication\FailureHandler\RedirectHandler;
use localzet\Auth\Authentication\FailureHandler\ResponseHandler;
use localzet\Auth\Authentication\FailureHandler\ThrowExceptionHandler;


return [
    'default' => 'user',
    'guards' => [
        'user' => [
            'class' => localzet\Auth\Guard\Guard::class,
            'identityRepository' => function () {
                return new Users();
            },
            'authenticationMethod' => function (IdentityRepositoryInterface $identityRepository) {
                return new JwtMethod($identityRepository);
            },
            'authenticationFailureHandler' => function () {
                return new ResponseHandler();
            },
        ]
    ]
];
