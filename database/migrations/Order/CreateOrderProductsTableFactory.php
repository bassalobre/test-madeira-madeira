<?php

namespace TesteMadeiraMadeira\Database\Migrations\Order;

use TesteMadeiraMadeira\Tools\DBConnection\DBConnection;
use TesteMadeiraMadeira\Tools\DBExecute\DBExecute;
use TesteMadeiraMadeira\Tools\DBExecute\FactoryDBExecuteContract;

class CreateOrderProductsTableFactory implements FactoryDBExecuteContract
{

    public static function create() : DBExecute
    {
        $dbConnection = DBConnection::getInstance();
        return new CreateOrderProductsTable($dbConnection);
    }
}
