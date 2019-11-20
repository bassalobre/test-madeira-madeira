<?php

namespace TesteMadeiraMadeira\Database\Migrations\Order;

use TesteMadeiraMadeira\Tools\DBConnection\DBConnectionContract;
use TesteMadeiraMadeira\Tools\DBExecute\DBExecute;

class CreateOrdersTable extends DBExecute
{

    public function __construct(DBConnectionContract $dbConnection)
    {
        $sql = '
            CREATE TABLE IF NOT EXISTS orders (
                id INT NOT NULL AUTO_INCREMENT,
                customer_id INT NOT NULL,
                price float NOT NULL,
                created_at DATETIME NOT NULL,
                CONSTRAINT orders_PK PRIMARY KEY (id),
                CONSTRAINT orders_customers_FK FOREIGN KEY (customer_id) REFERENCES customers(id)
            )
            ENGINE=InnoDB
            DEFAULT CHARSET=utf8
            COLLATE=utf8_general_ci
        ';

        parent::__construct($dbConnection, $sql);
    }
}
