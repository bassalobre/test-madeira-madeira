<?php

use Psr\Container\ContainerInterface;
use TesteMadeiraMadeira\Tools\DBConnection\DBConnection;

return [
    // User Domain
    'UserRepository' => function () {
        return new \TesteMadeiraMadeira\User\UserRepository(DBConnection::getInstance());
    },
    'UserService' => function (ContainerInterface $container) {
        return new \TesteMadeiraMadeira\User\UserService($container->get('UserRepository'));
    },
    'UserController' => function (ContainerInterface $container) {
        return new \TesteMadeiraMadeira\User\UserController($container->get('UserService'));
    },

    // Customer Domain
    'CustomerRepository' => function () {
        return new \TesteMadeiraMadeira\Customer\CustomerRepository(DBConnection::getInstance());
    },
    'CustomerService' => function (ContainerInterface $container) {
        return new \TesteMadeiraMadeira\Customer\CustomerService($container->get('CustomerRepository'));
    },
    'CustomerController' => function (ContainerInterface $container) {
        return new \TesteMadeiraMadeira\Customer\CustomerController($container->get('CustomerService'));
    },

    // Product Domain
    'ProductRepository' => function () {
        return new \TesteMadeiraMadeira\Product\ProductRepository(DBConnection::getInstance());
    },
    'ProductService' => function (ContainerInterface $container) {
        return new \TesteMadeiraMadeira\Product\ProductService($container->get('ProductRepository'));
    },
    'ProductController' => function (ContainerInterface $container) {
        return new \TesteMadeiraMadeira\Product\ProductController($container->get('ProductService'));
    },

    // Order Domain
    'OrderRepository' => function () {
        return new \TesteMadeiraMadeira\Order\OrderRepository(DBConnection::getInstance());
    },
    'OrderService' => function (ContainerInterface $container) {
        return new \TesteMadeiraMadeira\Order\OrderService(
            $container->get('OrderRepository'),
            $container->get('CustomerService'),
            $container->get('ProductService')
        );
    },
    'OrderController' => function (ContainerInterface $container) {
        return new \TesteMadeiraMadeira\Order\OrderController($container->get('OrderService'));
    },

    // Topic Domain
    'TopicRepository' => function () {
        return new \TesteMadeiraMadeira\KnowledgeBase\Topic\TopicRepository(DBConnection::getInstance());
    },
    'TopicService' => function (ContainerInterface $container) {
        return new \TesteMadeiraMadeira\KnowledgeBase\Topic\TopicService($container->get('TopicRepository'));
    },
    'TopicController' => function (ContainerInterface $container) {
        return new \TesteMadeiraMadeira\KnowledgeBase\Topic\TopicController($container->get('TopicService'));
    },
];
