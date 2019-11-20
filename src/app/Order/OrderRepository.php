<?php

namespace TesteMadeiraMadeira\Order;

use PDO;
use TesteMadeiraMadeira\tools\DBConnection\DBConnectionContract;
use TesteMadeiraMadeira\Core\ModelContract;
use TesteMadeiraMadeira\Core\RepositoryContract;

class OrderRepository implements RepositoryContract
{

    private $dbConnection;
    private $model;

    public function __construct(DBConnectionContract $dbConnection, ModelContract $model)
    {
        $this->dbConnection = $dbConnection;
        $this->model = $model;
    }

    public function getAllOrders() : array
    {
        $sql = '
            SELECT o.id, o.customer_id, c.name AS customer_name, o.price, o.created_at FROM orders o
            JOIN customers c ON o.customer_id = c.id
            ORDER BY o.created_at DESC
        ';

        $result = $this
            ->dbConnection
            ->getConnection()
            ->query($sql);

        return $result->fetchAll(PDO::FETCH_OBJ);
    }

    public function getAllOrderProductsByOrderId(int $orderId) : array
    {
        $sql = '
            SELECT * FROM order_products
            WHERE order_id = :order_id
            ORDER BY product_id
        ';

        $statement = $this
            ->dbConnection
            ->getConnection()
            ->prepare($sql);

        $statement->bindParam('order_id', $orderId);

        if ($statement->execute() && $statement->rowCount() > 0) {
            return $statement->fetchAll(PDO::FETCH_OBJ);
        }

        return [];
    }

    public function getOrderById(int $id) :? ModelContract
    {
        $sql = '
            SELECT * FROM orders
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
