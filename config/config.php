<?php

use Psr\Container\ContainerInterface;
use TesteMadeiraMadeira\Tools\DBConnection\DBConnection;

return [
    'UserRepository' => function () {
        return new \TesteMadeiraMadeira\Account\User\UserRepository(DBConnection::getInstance(), new \TesteMadeiraMadeira\Account\User\User());
    },
    'UserService' => function (ContainerInterface  $container) {
        return new \TesteMadeiraMadeira\Account\User\UserService($container->get('UserRepository'));
    },
    'AuthController' => function (ContainerInterface  $container) {
        return new \TesteMadeiraMadeira\Account\AuthController($container->get('UserService'));
    },
];
