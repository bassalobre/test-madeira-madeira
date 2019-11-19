<?php

namespace TesteMadeiraMadeira\Tools;

use Exception;
use Monolog\Handler\FirePHPHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class Log
{

    public static function create() :? Logger
    {
        $today = date('d_m_Y');
        $stream = __DIR__ . "/../storage/logs/{$today}.log";

        try {
            $logger = new Logger('madeira_madeira');
            $logger->pushHandler(new StreamHandler($stream, Logger::DEBUG));
            $logger->pushHandler(new FirePHPHandler());

            return $logger;
        } catch (Exception $exception) {
            return null;
        }
    }
}
