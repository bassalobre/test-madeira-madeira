<?php

namespace TesteMadeiraMadeira\KnowledgeBase\Topic;

use PDO;
use TesteMadeiraMadeira\tools\DBConnection\DBConnectionContract;
use TesteMadeiraMadeira\Core\ModelContract;
use TesteMadeiraMadeira\Core\RepositoryContract;

class TopicRepository implements RepositoryContract
{

    private $dbConnection;

    public function __construct(DBConnectionContract $dbConnection)
    {
        $this->dbConnection = $dbConnection;
    }

    public function getAllTopics() : array
    {
        $sql = '
            SELECT * FROM topics
            WHERE deleted_at IS NULL
            ORDER BY name
        ';

        $result = $this
            ->dbConnection
            ->getConnection()
            ->query($sql);

        return $result->fetchAll(PDO::FETCH_OBJ);
    }

    public function getTopicById(int $id) :? ModelContract
    {
        $sql = '
            SELECT * FROM topics
            WHERE deleted_at IS NULL
            AND id = :id
        ';

        $statement = $this
            ->dbConnection
            ->getConnection()
            ->prepare($sql);

        $statement->bindParam('id', $id);

        if ($statement->execute() && $statement->rowCount() > 0) {
            $model = new Topic();
            $model->setModel($statement->fetch(PDO::FETCH_OBJ));

            return $model;
        }

        return null;
    }

    public function createTopic(array $data) :? ModelContract
    {
        $sql = '
            INSERT INTO topics (name, created_at, updated_at)
            VALUES (:name, NOW(), NOW());
        ';
        $sqlToGetRecentlyCreatedTopic = '
            SELECT * FROM topics
            WHERE deleted_at IS NULL
            AND id = (SELECT LAST_INSERT_ID());
        ';

        $connection = $this
            ->dbConnection
            ->getConnection();
        $connection
            ->prepare($sql)
            ->execute($data);

        $model = new Topic();
        $model->setModel(
            $connection
                ->query($sqlToGetRecentlyCreatedTopic)
                ->fetch(PDO::FETCH_OBJ)
        );

        return $model;
    }

    public function updateTopicById(int $id, array $data) : bool
    {
        $sql = '
            UPDATE topics
            SET name = :name, updated_at = NOW()
            WHERE id = :id;
        ';

        $statement = $this
            ->dbConnection
            ->getConnection()
            ->prepare($sql);

        $statement->bindParam('id', $id);
        $statement->bindParam('name', $data['name']);

        return $statement->execute();
    }

    public function deleteTopicById(int $id) : bool
    {
        $sql = '
            UPDATE topics
            SET deleted_at = NOW()
            WHERE id = :id;
        ';

        $statement = $this
            ->dbConnection
            ->getConnection()
            ->prepare($sql);

        $statement->bindParam('id', $id);

        return $statement->execute();
    }
}
