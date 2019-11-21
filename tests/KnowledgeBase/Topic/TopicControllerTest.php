<?php

namespace TesteMadeiraMadeira\Tests\KnowledgeBase\Topic;

use TesteMadeiraMadeira\KnowledgeBase\Topic\Topic;
use TesteMadeiraMadeira\KnowledgeBase\Topic\TopicController;
use TesteMadeiraMadeira\KnowledgeBase\Topic\TopicService;
use TesteMadeiraMadeira\Tests\TestCase;

class TopicControllerTest extends TestCase
{

    public function testListAllTopics() : void
    {
        $controller = $this
            ->getContainer()
            ->get('TopicController');
        $response = json_decode($controller->listAllTopics(), true);

        $this->assertArrayHasKey('data', $response);
        $this->assertArrayHasKey('status', $response);
        $this->assertEquals(200, $response['status']);
        $this->assertEquals(true, is_array($response['data']));
    }

    public function testGetTopicById() : void
    {
        $controller = $this
            ->getContainer()
            ->get('TopicController');
        $topic = json_decode($controller->createTopic(['name' => 'Tópico Teste']));

        $this->assertEquals(
            json_encode(['data' => $topic->data, 'status' => 200]),
            $controller->getTopicById($topic->data->id)
        );
    }

    public function testGetTopicByIdWithInvalidId() : void
    {
        $controller = $this
            ->getContainer()
            ->get('TopicController');

        $this->assertEquals(
            json_encode(['data' => 'Tópico não encontrado.', 'status' => 404]),
            $controller->getTopicById(0)
        );
    }

    public function testCreateTopicSuccess() : void
    {
        $controller = $this
            ->getContainer()
            ->get('TopicController');
        $data = ['name' => 'Tópico Teste'];
        $response = json_decode($controller->createTopic($data), true);

        $this->assertArrayHasKey('data', $response);
        $this->assertArrayHasKey('status', $response);
        $this->assertEquals(201, $response['status']);
        $this->assertEquals($data['name'], $response['data']['name']);
    }

    public function testCreateTopicWithEmptyNameParam() : void
    {
        $controller = $this
            ->getContainer()
            ->get('TopicController');

        $this->assertEquals(
            json_encode(['data' => 'O campo Nome é obrigatório.', 'status' => 422]),
            $controller->createTopic(['name' => ''])
        );
    }

    public function testCreateTopicWithoutNameParam() : void
    {
        $controller = $this
            ->getContainer()
            ->get('TopicController');

        $this->assertEquals(
            json_encode(['data' => 'O campo Nome é obrigatório.', 'status' => 422]),
            $controller->createTopic([])
        );
    }

    public function testCreateTopicShouldReturnError() : void
    {
        $service = $this->createMock(TopicService::class);
        $service
            ->method('createTopic')
            ->willReturn(null);
        $controller = new TopicController($service);

        $this->assertEquals(
            json_encode(['data' => 'Erro ao criar Tópico.', 'status' => 400]),
            $controller->createTopic(['name' => 'Tópico Teste'])
        );
    }

    public function testUpdateTopicSuccess() : void
    {
        $controller = $this
            ->getContainer()
            ->get('TopicController');

        $data = ['name' => 'Tópico Teste de Edição'];
        $dataToUpdate = ['name' => 'Tópico Teste Editado'];
        $topic = json_decode($controller->createTopic($data), true);
        $response = json_decode($controller->updateTopic($topic['data']['id'], $dataToUpdate), true);

        $this->assertArrayHasKey('data', $response);
        $this->assertArrayHasKey('status', $response);
        $this->assertEquals(200, $response['status']);
        $this->assertEquals($dataToUpdate['name'], $response['data']['name']);
        $this->assertNotEquals($data['name'], $response['data']['name']);
    }

    public function testUpdateTopicWithEmptyNameParam() : void
    {
        $controller = $this
            ->getContainer()
            ->get('TopicController');

        $this->assertEquals(
            json_encode(['data' => 'O campo Nome é obrigatório.', 'status' => 422]),
            $controller->updateTopic(2, ['name' => ''])
        );
    }

    public function testUpdateTopicWithoutNameParam() : void
    {
        $controller = $this
            ->getContainer()
            ->get('TopicController');

        $this->assertEquals(
            json_encode(['data' => 'O campo Nome é obrigatório.', 'status' => 422]),
            $controller->updateTopic(2, [])
        );
    }

    public function testUpdateTopicWithInvalidId() : void
    {
        $controller = $this
            ->getContainer()
            ->get('TopicController');

        $this->assertEquals(
            json_encode(['data' => 'Tópico não encontrado.', 'status' => 404]),
            $controller->updateTopic(0, ['name' => 'Tópico Teste de Edição'])
        );
    }

    public function testUpdateTopicShouldReturnError() : void
    {
        $topic = new Topic();
        $topic->id = 2;
        $service = $this->createMock(TopicService::class);
        $service
            ->method('getTopicById')
            ->willReturn($topic);
        $service
            ->method('updateTopicById')
            ->willReturn(null);
        $controller = new TopicController($service);

        $this->assertEquals(
            json_encode(['data' => 'Erro ao editar Tópico.', 'status' => 400]),
            $controller->updateTopic($topic->id, ['name' => 'Tópico Teste de Edição'])
        );
    }

    public function testDeleteTopicSuccess() : void
    {
        $controller = $this
            ->getContainer()
            ->get('TopicController');
        $topic = json_decode($controller->createTopic(['name' => 'Tópico Teste de Exclusão']), true);
        $response = $controller->deleteTopic($topic['data']['id']);

        $this->assertEquals(
            json_encode(['data' => 'Tópico excluido com sucesso!', 'status' => 204]),
            $response
        );
        $this->assertEquals(
            json_encode(['data' => 'Tópico não encontrado.', 'status' => 404]),
            $controller->getTopicById($topic['data']['id'])
        );
    }

    public function testDeleteTopicWithInvalidId() : void
    {
        $controller = $this
            ->getContainer()
            ->get('TopicController');

        $this->assertEquals(
            json_encode(['data' => 'Tópico não encontrado.', 'status' => 404]),
            $controller->deleteTopic(0)
        );
    }

    public function testDeleteTopicShouldReturnError() : void
    {
        $topic = new Topic();
        $topic->id = 1;
        $service = $this->createMock(TopicService::class);
        $service
            ->method('getTopicById')
            ->willReturn($topic);
        $service
            ->method('deleteTopicById')
            ->willReturn(false);
        $controller = new TopicController($service);

        $this->assertEquals(
            json_encode(['data' => 'Erro ao excluir Tópico.', 'status' => 400]),
            $controller->deleteTopic($topic->id)
        );
    }
}
