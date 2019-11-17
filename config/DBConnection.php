<?php

namespace TesteMadeiraMadeira\Config;

use PDO;

class DBConnection
{

    private static $instance;

    private function __construct()
    {
        //
    }

    private function __clone()
    {
        //
    }

    private function __wakeup()
    {
        //
    }

    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            $driver = Env::get('DB_DRIVER');
            $host = Env::get('DB_HOST');
            $port = Env::get('DB_PORT');
            $database = Env::get('DB_DATABASE');
            $user = Env::get('DB_USERNAME');
            $password = Env::get('DB_PASSWORD');

            self::$instance = new PDO(
                $driver . ':host=' . $host . ';port=' . $port . ';dbname=' . $database,
                $user,
                $password
            );
            self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        return self::$instance;
    }
}
