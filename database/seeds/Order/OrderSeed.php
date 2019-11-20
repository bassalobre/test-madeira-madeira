<?php

namespace TesteMadeiraMadeira\Database\Seeds\Order;

use TesteMadeiraMadeira\Tools\DBConnection\DBConnectionContract;
use TesteMadeiraMadeira\Tools\DBExecute\DBExecute;

class OrderSeed extends DBExecute
{

    public function __construct(DBConnectionContract $dbConnection)
    {
        $sql = "
            INSERT INTO orders (id, customer_id, price, created_at)
            VALUES
                   (1, 1, 3299.99, '2019-11-19 22:00:00'),
                   (2, 2, 3299.99, '2019-11-19 23:00:00');
        ";

        parent::__construct($dbConnection, $sql);
    }
}
