<?php

namespace TesteMadeiraMadeira\Config;

class Env
{

    private static function load() : void
    {
        $env = file_get_contents(__DIR__ . '/../.env');
        $arrayEnv = explode("\n", $env);

        foreach ($arrayEnv as $var) {
            if ($var != "" && strpos($var, '#') !== 0) {
                putenv(trim($var));
            }
        }
    }

    public static function get(string $key) : string
    {
        self::load();

        return getenv($key);
    }
}
