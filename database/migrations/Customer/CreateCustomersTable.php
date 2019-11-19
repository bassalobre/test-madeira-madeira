<?php

namespace TesteMadeiraMadeira\Database\Migrations\Customer;

use TesteMadeiraMadeira\Tools\DBConnection\DBConnectionContract;
use TesteMadeiraMadeira\Tools\DBExecute\DBExecute;

class CreateCustomersTable extends DBExecute
{

    public function __construct(DBConnectionContract $dbConnection)
    {
        $sql = '
            CREATE TABLE IF NOT EXISTS customers (
                id INT NOT NULL AUTO_INCREMENT,
                name varchar(100) NOT NULL,
                cpf varchar(14) NOT NULL,
                phone varchar(15) NULL,
                email varchar(100) NOT NULL,
                password varchar(100) NOT NULL,
                CONSTRAINT customers_PK PRIMARY KEY (id)
            )
            ENGINE=InnoDB
            DEFAULT CHARSET=utf8
            COLLATE=utf8_general_ci
        ';

        parent::__construct($dbConnection, $sql);
    }
}
