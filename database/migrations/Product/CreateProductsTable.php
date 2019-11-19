<?php

namespace TesteMadeiraMadeira\Database\Migrations\Product;

use TesteMadeiraMadeira\Tools\DBConnection\DBConnectionContract;
use TesteMadeiraMadeira\Tools\DBExecute\DBExecute;

class CreateProductsTable extends DBExecute
{

    public function __construct(DBConnectionContract $dbConnection)
    {
        $sql = '
            CREATE TABLE IF NOT EXISTS products (
                id INT NOT NULL AUTO_INCREMENT,
                name varchar(100) NOT NULL,
                description varchar(100) NULL,
                price float NOT NULL,
                CONSTRAINT products_PK PRIMARY KEY (id)
            )
            ENGINE=InnoDB
            DEFAULT CHARSET=utf8
            COLLATE=utf8_general_ci
        ';

        parent::__construct($dbConnection, $sql);
    }
}
