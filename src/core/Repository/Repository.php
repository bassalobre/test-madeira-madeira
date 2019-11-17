<?php

namespace TesteMadeiraMadeira\Core\Repository;

use TesteMadeiraMadeira\Core\Model\ModelContract;
use TesteMadeiraMadeira\Config\DBConnection;

abstract class Repository
{

    protected $dbConnection;

    public function __construct()
    {
        $this->dbConnection = DBConnection::getInstance();
    }
}
