<?php

namespace TesteMadeiraMadeira\Database\Seeds\User;

use TesteMadeiraMadeira\Tools\DBConnection\DBConnectionContract;
use TesteMadeiraMadeira\Tools\DBExecute\DBExecute;

class UserSeed extends DBExecute
{

    public function __construct(DBConnectionContract $dbConnection)
    {
        $password = password_hash('secret', PASSWORD_ARGON2I);
        $sql = "
            INSERT INTO users (id, name, login, password)
            VALUES (1, 'William Bassalobre', 'bassalobre', '{$password}');
        ";

        parent::__construct($dbConnection, $sql);
    }
}
