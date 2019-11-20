<?php

namespace TesteMadeiraMadeira\Database\Seeds\Order;

use TesteMadeiraMadeira\Tools\DBConnection\DBConnection;
use TesteMadeiraMadeira\Tools\DBExecute\DBExecute;
use TesteMadeiraMadeira\Tools\DBExecute\FactoryDBExecuteContract;

class OrderSeedFactory implements FactoryDBExecuteContract
{

    public static function create() : DBExecute
    {
        $dbConnection = DBConnection::getInstance();
        return new OrderSeed($dbConnection);
    }
}
