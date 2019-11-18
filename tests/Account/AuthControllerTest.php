<?php

namespace TesteMadeiraMadeira\Tests\Account;

use stdClass;
use TesteMadeiraMadeira\Tests\TestCase;

class AuthControllerTest extends TestCase
{

    public function testLoginSuccess() : void
    {
        $controller = $this
            ->getContainer()
            ->get('AuthController');
        $data = ['login' => 'bassalobre', 'password' => 'secret'];
        $user = new stdClass();
        $user->id = 1;
        $user->name = 'William Bassalobre';

        $this->assertEquals(
            json_encode(['data' => $user, 'status' => 200]),
            $controller->login($data)
        );
    }

    public function testLoginWithInvalidLogin() : void
    {
        $controller = $this
            ->getContainer()
            ->get('AuthController');
        $data = ['login' => 'souza', 'password' => 'secret'];

        $this->assertEquals(
            json_encode(['data' => 'Credenciais Inválidas', 'status' => 401]),
            $controller->login($data)
        );
    }

    public function testLoginWithEmptyLoginParam() : void
    {
        $controller = $this
            ->getContainer()
            ->get('AuthController');
        $data = ['login' => '', 'password' => 'secret'];

        $this->assertEquals(
            json_encode(['data' => 'O campo Usuário é obrigatório.', 'status' => 422]),
            $controller->login($data)
        );
    }

    public function testLoginWithoutLoginParam() : void
    {
        $controller = $this
            ->getContainer()
            ->get('AuthController');
        $data = ['password' => 'secret'];

        $this->assertEquals(
            json_encode(['data' => 'O campo Usuário é obrigatório.', 'status' => 422]),
            $controller->login($data)
        );
    }

    public function testLoginWithInvalidPassword() : void
    {
        $controller = $this
            ->getContainer()
            ->get('AuthController');
        $data = ['login' => 'bassalobre', 'password' => '123456'];

        $this->assertEquals(
            json_encode(['data' => 'Credenciais Inválidas', 'status' => 401]),
            $controller->login($data)
        );
    }

    public function testLoginWithEmptyPasswordParam() : void
    {
        $controller = $this
            ->getContainer()
            ->get('AuthController');
        $data = ['login' => 'bassalobre', 'password' => ''];

        $this->assertEquals(
            json_encode(['data' => 'O campo Senha é obrigatório.', 'status' => 422]),
            $controller->login($data)
        );
    }

    public function testLoginWithoutPasswordParam() : void
    {
        $controller = $this
            ->getContainer()
            ->get('AuthController');
        $data = ['login' => 'bassalobre'];

        $this->assertEquals(
            json_encode(['data' => 'O campo Senha é obrigatório.', 'status' => 422]),
            $controller->login($data)
        );
    }

    public function testLoginWithoutAnyParam() : void
    {
        $controller = $this
            ->getContainer()
            ->get('AuthController');
        $data = [];

        $this->assertEquals(
            json_encode(['data' => 'O campo Usuário é obrigatório.', 'status' => 422]),
            $controller->login($data)
        );
    }
}
