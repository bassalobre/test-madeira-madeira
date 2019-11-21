<?php

namespace TesteMadeiraMadeira\User;

use PDO;
use TesteMadeiraMadeira\tools\DBConnection\DBConnectionContract;
use TesteMadeiraMadeira\Core\ModelContract;
use TesteMadeiraMadeira\Core\RepositoryContract;

class UserRepository implements RepositoryContract
{

    private $dbConnection;

    public function __construct(DBConnectionContract $dbConnection)
    {
        $this->dbConnection = $dbConnection;
    }

    public function getUserByLogin(string $login) :? ModelContract
    {
        $sql = '
            SELECT * FROM users
            WHERE login = :login
        ';

        $statement = $this
            ->dbConnection
            ->getConnection()
            ->prepare($sql);

        $statement->bindParam('login', $login);

        if ($statement->execute() && $statement->rowCount() > 0) {
            $model = new User();
            $model->setModel($statement->fetch(PDO::FETCH_OBJ));

            return $model;
        }

        return null;
    }
}
