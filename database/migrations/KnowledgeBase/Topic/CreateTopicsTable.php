<?php

namespace TesteMadeiraMadeira\Database\Migrations\KnowledgeBase\Topic;

use TesteMadeiraMadeira\Tools\DBConnection\DBConnectionContract;
use TesteMadeiraMadeira\Tools\DBExecute\DBExecute;

class CreateTopicsTable extends DBExecute
{

    public function __construct(DBConnectionContract $dbConnection)
    {
        $sql = '
            CREATE TABLE IF NOT EXISTS topics (
                id INT NOT NULL AUTO_INCREMENT,
                name varchar(100) NOT NULL,
                created_at DATETIME NOT NULL,
                updated_at DATETIME NOT NULL,
                deleted_at DATETIME NULL,
                CONSTRAINT topics_PK PRIMARY KEY (id)
            )
            ENGINE=InnoDB
            DEFAULT CHARSET=utf8
            COLLATE=utf8_general_ci
        ';

        parent::__construct($dbConnection, $sql);
    }
}
