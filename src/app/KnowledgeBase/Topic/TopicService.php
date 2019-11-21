<?php

namespace TesteMadeiraMadeira\KnowledgeBase\Topic;

use TesteMadeiraMadeira\Core\ModelContract;
use TesteMadeiraMadeira\Core\RepositoryContract;
use TesteMadeiraMadeira\Core\ServiceContract;

class TopicService implements ServiceContract
{
    private $repository;

    public function __construct(RepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function listAllTopics() : array
    {
        return $this
            ->repository
            ->getAllTopics();
    }

    public function getTopicById(int $id) :? ModelContract
    {
        return $this
            ->repository
            ->getTopicById($id);
    }

    public function createTopic(array $data) :? ModelContract
    {
        return $this
            ->repository
            ->createTopic($data);
    }

    public function updateTopicById(int $id, array $data) :? ModelContract
    {
        $updated =  $this
            ->repository
            ->updateTopicById($id, $data);

        return $updated ? $this->getTopicById($id) : null;
    }

    public function deleteTopicById(int $id) : bool
    {
        return $this
            ->repository
            ->deleteTopicById($id);
    }
}
