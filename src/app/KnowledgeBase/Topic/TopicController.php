<?php

namespace TesteMadeiraMadeira\KnowledgeBase\Topic;

use TesteMadeiraMadeira\Core\ServiceContract;
use TesteMadeiraMadeira\Tools\Log;

class TopicController
{
    private $service;

    public function __construct(ServiceContract $service)
    {
        $this->service = $service;
    }

    public function listAllTopics() : string
    {
        $topics = $this
            ->service
            ->listAllTopics();

        return json_encode(['data' => $topics, 'status' => 200]);
    }

    public function getTopicById(int $id) : string
    {
        $topic = $this
            ->service
            ->getTopicById($id);

        if (!$topic) {
            Log::create()->notice('TopicController: Tópico não encontrado.', ['id' => $id]);
            return json_encode(['data' => 'Tópico não encontrado.', 'status' => 404]);
        }

        return json_encode(['data' => $topic, 'status' => 200]);
    }

    public function createTopic(array $data) : string
    {
        $validate = $this->validateRequest($data);

        if (!$validate['isValid']) {
            Log::create()->info('TopicController: ' . $validate['message'], $data);
            return json_encode(['data' => $validate['message'], 'status' => 422]);
        }

        $topic = $this
            ->service
            ->createTopic($data);

        if (!$topic) {
            Log::create()->error('TopicController: Erro ao criar Tópico.', $data);
            return json_encode(['data' => 'Erro ao criar Tópico.', 'status' => 400]);
        }

        return json_encode(['data' => $topic, 'status' => 201]);
    }

    public function updateTopic(int $id, array $data) : string
    {
        $validate = $this->validateRequest($data);

        if (!$validate['isValid']) {
            Log::create()->info('TopicController: ' . $validate['message'], $data);
            return json_encode(['data' => $validate['message'], 'status' => 422]);
        }

        $topic = $this
            ->service
            ->getTopicById($id);

        if (!$topic) {
            Log::create()->notice('TopicController: Tópico não encontrado.', ['id' => $id]);
            return json_encode(['data' => 'Tópico não encontrado.', 'status' => 404]);
        }

        $topicUpdated = $this
            ->service
            ->updateTopicById($topic->id, $data);

        if (!$topicUpdated) {
            Log::create()->error('TopicController: Erro ao editar Tópico.', ['id' => $id, 'data' => $data]);
            return json_encode(['data' => 'Erro ao editar Tópico.', 'status' => 400]);
        }

        return json_encode(['data' => $topicUpdated, 'status' => 200]);
    }

    public function deleteTopic(int $id) : string
    {
        $topic = $this
            ->service
            ->getTopicById($id);

        if (!$topic) {
            Log::create()->notice('TopicController: Tópico não encontrado.', ['id' => $id]);
            return json_encode(['data' => 'Tópico não encontrado.', 'status' => 404]);
        }

        $deleted = $this
            ->service
            ->deleteTopicById($topic->id);

        if (!$deleted) {
            Log::create()->error('TopicController: Erro ao excluir Tópico.', ['id' => $id]);
            return json_encode(['data' => 'Erro ao excluir Tópico.', 'status' => 400]);
        }

        return json_encode(['data' => 'Tópico excluido com sucesso!', 'status' => 204]);
    }

    private function validateRequest(array $data) : array
    {
        if (!array_key_exists('name', $data) || !$data['name']) {
            return [
                'isValid' => false,
                'message' => 'O campo Nome é obrigatório.',
            ];
        }

        return [
            'isValid' => true,
        ];
    }
}
