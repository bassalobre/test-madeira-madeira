<?php

namespace TesteMadeiraMadeira\Product;

use PDO;
use TesteMadeiraMadeira\tools\DBConnection\DBConnectionContract;
use TesteMadeiraMadeira\Core\ModelContract;
use TesteMadeiraMadeira\Core\RepositoryContract;

class ProductRepository implements RepositoryContract
{

    private $dbConnection;

    public function __construct(DBConnectionContract $dbConnection)
    {
        $this->dbConnection = $dbConnection;
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
            $model = new Product();
            $model->setModel($statement->fetch(PDO::FETCH_OBJ));

            return $model;
        }

        return null;
    }
}
