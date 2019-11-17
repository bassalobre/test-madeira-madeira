<?php

namespace TesteMadeiraMadeira\Account\User;

use TesteMadeiraMadeira\Core\Model\ModelContract;
use TesteMadeiraMadeira\Core\Repository\Repository;
use TesteMadeiraMadeira\Core\Repository\RepositoryContract;

class UserRepository extends Repository implements RepositoryContract
{

    private $model;

    public function __construct(ModelContract $model)
    {
        $this->model = $model;

        parent::__construct();
    }

    public function getUserByLogin(string $login)
    {
        $sql = '
            SELECT * FROM users
            WHERE login = :login
        ';

        $statement = $this
            ->dbConnection
            ->prepare($sql);

        $statement->bindParam('login', $login);

        if ($statement->execute() && $statement->rowCount() > 0) {
            $this
                ->model
                ->setModel($statement->fetch(\PDO::FETCH_OBJ));

            return $this
                ->model
                ->getModel();
        }

        return null;
    }
}
