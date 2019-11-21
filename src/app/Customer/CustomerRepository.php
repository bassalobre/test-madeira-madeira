<?php

namespace TesteMadeiraMadeira\Customer;

use PDO;
use TesteMadeiraMadeira\tools\DBConnection\DBConnectionContract;
use TesteMadeiraMadeira\Core\ModelContract;
use TesteMadeiraMadeira\Core\RepositoryContract;

class CustomerRepository implements RepositoryContract
{

    private $dbConnection;

    public function __construct(DBConnectionContract $dbConnection)
    {
        $this->dbConnection = $dbConnection;
    }

    public function getAllCustomers() : array
    {
        $sql = '
            SELECT id, name, cpf, phone, email FROM customers
            ORDER BY name
        ';

        $result = $this
            ->dbConnection
            ->getConnection()
            ->query($sql);

        return $result->fetchAll(PDO::FETCH_OBJ);
    }

    public function getCustomerById(int $id) :? ModelContract
    {
        $sql = '
            SELECT id, name, cpf, phone, email FROM customers
            WHERE id = :id
        ';

        $statement = $this
            ->dbConnection
            ->getConnection()
            ->prepare($sql);

        $statement->bindParam('id', $id);

        if ($statement->execute() && $statement->rowCount() > 0) {
            $model = new Customer();
            $model->setModel($statement->fetch(PDO::FETCH_OBJ));

            return $model;
        }

        return null;
    }

    public function getCustomerByEmail(string $email) :? ModelContract
    {
        $sql = '
            SELECT * FROM customers
            WHERE email = :email
        ';

        $statement = $this
            ->dbConnection
            ->getConnection()
            ->prepare($sql);

        $statement->bindParam('email', $email);

        if ($statement->execute() && $statement->rowCount() > 0) {
            $model = new Customer();
            $model->setModel($statement->fetch(PDO::FETCH_OBJ));

            return $model;
        }

        return null;
    }
}
