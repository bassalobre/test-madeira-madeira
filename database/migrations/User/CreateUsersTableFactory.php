<?php

namespace TesteMadeiraMadeira\Database\Migrations\User;

use TesteMadeiraMadeira\Tools\DBConnection\DBConnection;
use TesteMadeiraMadeira\Tools\DBExecute\DBExecute;
use TesteMadeiraMadeira\Tools\DBExecute\FactoryDBExecuteContract;

class CreateUsersTableFactory implements FactoryDBExecuteContract
{

    public static function create() : DBExecute
    {
        $dbConnection = DBConnection::getInstance();
        return new CreateUsersTable($dbConnection);
    }
}
