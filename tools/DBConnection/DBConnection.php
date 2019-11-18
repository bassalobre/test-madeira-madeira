<?php

namespace TesteMadeiraMadeira\Tools\DBConnection;

use PDO;
use TesteMadeiraMadeira\Tools\Env;

class DBConnection implements DBConnectionContract
{

    private static $instance;
    private static $connection;

    private function __construct()
    {
        $driver = Env::get('DB_DRIVER');
        $host = Env::get('DB_HOST');
        $port = Env::get('DB_PORT');
        $database = Env::get('DB_DATABASE');
        $user = Env::get('DB_USERNAME');
        $password = Env::get('DB_PASSWORD');

        self::$connection = new PDO(
            $driver . ':host=' . $host . ';port=' . $port . ';dbname=' . $database,
            $user,
            $password
        );
        self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    private function __clone()
    {
        //
    }

    public static function getInstance() : DBConnection
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function getConnection() : PDO
    {
        return self::$connection;
    }
}
