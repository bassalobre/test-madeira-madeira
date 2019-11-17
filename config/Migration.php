<?php

namespace TesteMadeiraMadeira\Config;

abstract class Migration
{

    private $dbConnection;
    private $sql;

    public function __construct(string $sql)
    {
        $this->dbConnection = DBConnection::getInstance();
        $this->sql = $sql;
    }

    public function run() : void
    {
        $statement = $this
            ->dbConnection
            ->prepare($this->sql);

        $statement->execute();
    }
}
