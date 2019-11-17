<?php

namespace TesteMadeiraMadeira\Core\Repository;

use TesteMadeiraMadeira\Core\Model\ModelContract;
use TesteMadeiraMadeira\Config\DBConnection;

abstract class Repository
{

    protected $dbConnection;
    protected $model;

    public function __construct(ModelContract $model)
    {
        $this->dbConnection = DBConnection::getInstance();
        $this->model = $model;
    }
}
