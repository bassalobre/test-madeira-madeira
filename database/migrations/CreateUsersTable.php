<?php

namespace TesteMadeiraMadeira\Database\Migrations;

use TesteMadeiraMadeira\Config\Migration;

class CreateUsersTable extends Migration
{

    public function __construct()
    {
        $sql = '
            CREATE TABLE IF NOT EXISTS users (
                id INT NOT NULL AUTO_INCREMENT,
                name varchar(100) NULL,
                login varchar(100) NOT NULL,
                password varchar(100) NOT NULL,
                CONSTRAINT users_PK PRIMARY KEY (id)
            )
            ENGINE=InnoDB
            DEFAULT CHARSET=utf8
            COLLATE=utf8_general_ci
        ';

        parent::__construct($sql);
    }
}
