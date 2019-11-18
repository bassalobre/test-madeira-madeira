<?php

namespace TesteMadeiraMadeira\Database\Seeds\User;

use TesteMadeiraMadeira\Tools\DBConnection\DBConnection;
use TesteMadeiraMadeira\Tools\DBExecute\DBExecute;
use TesteMadeiraMadeira\Tools\DBExecute\FactoryDBExecuteContract;

class UserSeedFactory implements FactoryDBExecuteContract
{

    public static function create() : DBExecute
    {
        $dbConnection = DBConnection::getInstance();
        return new UserSeed($dbConnection);
    }
}
