<?php

namespace TesteMadeiraMadeira\Database\Migrations\Order;

use TesteMadeiraMadeira\Tools\DBConnection\DBConnectionContract;
use TesteMadeiraMadeira\Tools\DBExecute\DBExecute;

class CreateOrderProductsTable extends DBExecute
{

    public function __construct(DBConnectionContract $dbConnection)
    {
        $sql = '
            CREATE TABLE IF NOT EXISTS order_products (
                id INT NOT NULL AUTO_INCREMENT,
                order_id INT NOT NULL,
                product_id INT NOT NULL,
                CONSTRAINT orders_PK PRIMARY KEY (id),
                CONSTRAINT order_products_orders_FK FOREIGN KEY (order_id) REFERENCES orders(id),
                CONSTRAINT order_products_products_FK FOREIGN KEY (product_id) REFERENCES products(id)
            )
            ENGINE=InnoDB
            DEFAULT CHARSET=utf8
            COLLATE=utf8_general_ci
        ';

        parent::__construct($dbConnection, $sql);
    }
}
