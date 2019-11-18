<?php

require __DIR__ . '/../vendor/autoload.php';

use TesteMadeiraMadeira\Database\Seeds\User\UserSeedFactory;

try {
    UserSeedFactory::create()->run();

    printf('Seeds executadas com sucesso.' . PHP_EOL);
} catch (Exception $exception) {
    die($exception->getMessage() . PHP_EOL);
}
