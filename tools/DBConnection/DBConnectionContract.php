<?php

namespace TesteMadeiraMadeira\Tools\DBConnection;

use PDO;

interface DBConnectionContract
{
    public function getConnection() : PDO;
}
