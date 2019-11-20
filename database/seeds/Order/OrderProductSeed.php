<?php

namespace TesteMadeiraMadeira\Database\Seeds\Order;

use TesteMadeiraMadeira\Tools\DBConnection\DBConnectionContract;
use TesteMadeiraMadeira\Tools\DBExecute\DBExecute;

class OrderProductSeed extends DBExecute
{

    public function __construct(DBConnectionContract $dbConnection)
    {
        $sql = "
            INSERT INTO order_products (id, order_id, product_id)
            VALUES
                   (1, 1, 1),
                   (2, 1, 2),
                   (3, 2, 1),
                   (4, 2, 2);
        ";

        parent::__construct($dbConnection, $sql);
    }
}
