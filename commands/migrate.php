<?php

require __DIR__ . '/../vendor/autoload.php';

use TesteMadeiraMadeira\Database\Migrations\CreateUsersTable;

try {
    $usersTable = new CreateUsersTable();
} catch (\Exception $exception) {
    die($exception->getMessage() . PHP_EOL);
}

$usersTable->run();

printf('Migrate executada com sucesso.' . PHP_EOL);
