<?php

namespace TesteMadeiraMadeira\Product;

use PDO;
use TesteMadeiraMadeira\tools\DBConnection\DBConnectionContract;
use TesteMadeiraMadeira\Core\ModelContract;
use TesteMadeiraMadeira\Core\RepositoryContract;

class ProductRepository implements RepositoryContract
{

    private $dbConnection;
    private $model;

    public function __construct(DBConnectionContract $dbConnection, ModelContract $model)
    {
        $this->dbConnection = $dbConnection;
        $this->model = $model;
    }

    public function getAllProducts() : array
    {
        $sql = '
            SELECT * FROM products
            ORDER BY name
        ';

        $result = $this
            ->dbConnection
            ->getConnection()
            ->query($sql);

        return $result->fetchAll(PDO::FETCH_OBJ);
    }

    public function getProductById(int $id) :? ModelContract
    {
        $sql = '
            SELECT * FROM products
            WHERE id = :id
        ';

        $statement = $this
            ->dbConnection
            ->getConnection()
            ->prepare($sql);

        $statement->bindParam('id', $id);

        if ($statement->execute() && $statement->rowCount() > 0) {
            $this
                ->model
                ->setModel($statement->fetch(PDO::FETCH_OBJ));

            return $this->model;
        }

        return null;
    }
}
