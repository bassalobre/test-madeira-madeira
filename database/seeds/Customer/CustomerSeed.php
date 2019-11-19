<?php

namespace TesteMadeiraMadeira\Database\Seeds\Customer;

use TesteMadeiraMadeira\Tools\DBConnection\DBConnectionContract;
use TesteMadeiraMadeira\Tools\DBExecute\DBExecute;

class CustomerSeed extends DBExecute
{

    public function __construct(DBConnectionContract $dbConnection)
    {
        $password = password_hash('secret', PASSWORD_ARGON2I);
        $sql = "
            INSERT INTO customers (id, name, cpf, phone, email, password)
            VALUES
                   (1, 'João da Silva', '123.456.789-00', '(44) 99999-9999', 'joao@mail.com', '{$password}'),
                   (2, 'Maria da Silva', '987.654.321-00', '(44) 88888-8888', 'maria@mail.com', '{$password}');
        ";

        parent::__construct($dbConnection, $sql);
    }
}
