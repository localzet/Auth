<?php

// identityRepository
use app\model\User;

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
                return new User();
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
