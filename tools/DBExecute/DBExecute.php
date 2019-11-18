<?php

namespace TesteMadeiraMadeira\Tools\DBExecute;

use TesteMadeiraMadeira\Tools\DBConnection\DBConnectionContract;

abstract class DBExecute
{

    private $dbConnection;
    private $sql;

    public function __construct(DBConnectionContract $dbConnection, string $sql)
    {
        $this->dbConnection = $dbConnection;
        $this->sql = $sql;
    }

    public function run() : void
    {
        $statement = $this
            ->dbConnection
            ->getConnection()
            ->prepare($this->sql);

        $statement->execute();
    }
}
