<?php

require __DIR__ . '/../vendor/autoload.php';

use TesteMadeiraMadeira\Database\Migrations\Customer\CreateCustomersTableFactory;
use TesteMadeiraMadeira\Database\Migrations\KnowledgeBase\Topic\CreateTopicsTableFactory;
use TesteMadeiraMadeira\Database\Migrations\Order\CreateOrderProductsTableFactory;
use TesteMadeiraMadeira\Database\Migrations\Order\CreateOrdersTableFactory;
use TesteMadeiraMadeira\Database\Migrations\Product\CreateProductsTableFactory;
use TesteMadeiraMadeira\Database\Migrations\User\CreateUsersTableFactory;

try {
    CreateUsersTableFactory::create()->run();
    CreateCustomersTableFactory::create()->run();
    CreateProductsTableFactory::create()->run();
    CreateOrdersTableFactory::create()->run();
    CreateOrderProductsTableFactory::create()->run();
    CreateTopicsTableFactory::create()->run();

    printf('Migrate executada com sucesso.' . PHP_EOL);
} catch (Exception $exception) {
    die($exception->getMessage() . PHP_EOL);
}
