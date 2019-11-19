<?php

use Psr\Container\ContainerInterface;
use TesteMadeiraMadeira\Tools\DBConnection\DBConnection;

return [
    // User Domain
    'UserRepository' => function () {
        return new \TesteMadeiraMadeira\User\UserRepository(DBConnection::getInstance(), new \TesteMadeiraMadeira\User\User());
    },
    'UserService' => function (ContainerInterface $container) {
        return new \TesteMadeiraMadeira\User\UserService($container->get('UserRepository'));
    },
    'UserController' => function (ContainerInterface $container) {
        return new \TesteMadeiraMadeira\User\UserController($container->get('UserService'));
    },

    // Customer Domain
    'CustomerRepository' => function () {
        return new \TesteMadeiraMadeira\Customer\CustomerRepository(DBConnection::getInstance(), new \TesteMadeiraMadeira\Customer\Customer());
    },
    'CustomerService' => function (ContainerInterface $container) {
        return new \TesteMadeiraMadeira\Customer\CustomerService($container->get('CustomerRepository'));
    },
    'CustomerController' => function (ContainerInterface $container) {
        return new \TesteMadeiraMadeira\Customer\CustomerController($container->get('CustomerService'));
    },

    // Product Domain
    'ProductRepository' => function () {
        return new \TesteMadeiraMadeira\Product\ProductRepository(DBConnection::getInstance(), new \TesteMadeiraMadeira\Product\Product());
    },
    'ProductService' => function (ContainerInterface $container) {
        return new \TesteMadeiraMadeira\Product\ProductService($container->get('ProductRepository'));
    },
    'ProductController' => function (ContainerInterface $container) {
        return new \TesteMadeiraMadeira\Product\ProductController($container->get('ProductService'));
    },
];
