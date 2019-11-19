<?php

namespace TesteMadeiraMadeira\Database\Seeds\Product;

use TesteMadeiraMadeira\Tools\DBConnection\DBConnectionContract;
use TesteMadeiraMadeira\Tools\DBExecute\DBExecute;

class ProductSeed extends DBExecute
{

    public function __construct(DBConnectionContract $dbConnection)
    {
        $sql = "
            INSERT INTO products (id, name, description, price)
            VALUES
                   (1, 'Cama', 'Cama box casal King', 1500),
                   (2, 'Televisão', 'Televisão Samgsung 50 Smart', 1799.99);
        ";

        parent::__construct($dbConnection, $sql);
    }
}
