<?php

namespace TesteMadeiraMadeira\Account\User;

use PDO;
use TesteMadeiraMadeira\tools\DBConnection\DBConnectionContract;
use TesteMadeiraMadeira\Core\ModelContract;
use TesteMadeiraMadeira\Core\RepositoryContract;

class UserRepository implements RepositoryContract
{

    private $dbConnection;
    private $model;

    public function __construct(DBConnectionContract $dbConnection, ModelContract $model)
    {
        $this->dbConnection = $dbConnection;
        $this->model = $model;
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
            $this
                ->model
                ->setModel($statement->fetch(PDO::FETCH_OBJ));

            return $this->model;
        }

        return null;
    }
}
