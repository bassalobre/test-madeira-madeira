<?php

require __DIR__ . '/../vendor/autoload.php';

use TesteMadeiraMadeira\Database\Migrations\User\CreateUsersTableFactory;

try {
    CreateUsersTableFactory::create()->run();

    printf('Migrate executada com sucesso.' . PHP_EOL);
} catch (Exception $exception) {
    die($exception->getMessage() . PHP_EOL);
}
