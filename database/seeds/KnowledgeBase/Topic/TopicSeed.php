<?php

namespace TesteMadeiraMadeira\Database\Seeds\KnowledgeBase\Topic;

use TesteMadeiraMadeira\Tools\DBConnection\DBConnectionContract;
use TesteMadeiraMadeira\Tools\DBExecute\DBExecute;

class TopicSeed extends DBExecute
{

    public function __construct(DBConnectionContract $dbConnection)
    {
        $date = '2019-11-21 01:00:00';
        $sql = "
            INSERT INTO topics (id, name, created_at, updated_at)
            VALUES
                   (1, 'Trocas e Devoluções', '{$date}', '{$date}'),
                   (2, 'Entrega e Prazo', '{$date}', '{$date}'),
                   (3, 'Cadastro e Conta', '{$date}', '{$date}'),
                   (4, 'Produtos e Serviços', '{$date}', '{$date}');
        ";

        parent::__construct($dbConnection, $sql);
    }
}
