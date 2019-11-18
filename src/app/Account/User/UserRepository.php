<?php

namespace TesteMadeiraMadeira\Account\User;

use PDO;
use TesteMadeiraMadeira\Tools\DBConnection\DBConnection;
use TesteMadeiraMadeira\tools\DBConnection\DBConnectionContract;
use TesteMadeiraMadeira\Core\ModelContract;
use TesteMadeiraMadeira\Core\RepositoryContract;

class UserRepository implements RepositoryContract
{
    /**
     * @Inject
     * @var DBConnection
     */
    private $dbConnection;
    /**
     * @Inject
     * @var User
     */
    private $model;

    public function __construct(DBConnectionContract $dbConnection, ModelContract $model)
    {
        $this->dbConnection = $dbConnection;
        $this->model = $model;
    }

    public function getUserByLogin(string $login) :? object
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

            return $this
                ->model
                ->getModel();
        }

        return null;
    }
}
