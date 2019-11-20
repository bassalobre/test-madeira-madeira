<?php

require __DIR__ . '/../vendor/autoload.php';

use TesteMadeiraMadeira\Database\Seeds\Customer\CustomerSeedFactory;
use TesteMadeiraMadeira\Database\Seeds\Order\OrderProductSeedFactory;
use TesteMadeiraMadeira\Database\Seeds\Order\OrderSeedFactory;
use TesteMadeiraMadeira\Database\Seeds\Product\ProductSeedFactory;
use TesteMadeiraMadeira\Database\Seeds\User\UserSeedFactory;

try {
    UserSeedFactory::create()->run();
    CustomerSeedFactory::create()->run();
    ProductSeedFactory::create()->run();
    OrderSeedFactory::create()->run();
    OrderProductSeedFactory::create()->run();

    printf('Seeds executadas com sucesso.' . PHP_EOL);
} catch (Exception $exception) {
    die($exception->getMessage() . PHP_EOL);
}
