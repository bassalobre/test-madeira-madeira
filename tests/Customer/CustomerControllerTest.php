<?php

namespace TesteMadeiraMadeira\Tests\Customer;

use TesteMadeiraMadeira\Customer\Customer;
use TesteMadeiraMadeira\Tests\TestCase;

class CustomerControllerTest extends TestCase
{

    public function testListAllCustomers() : void
    {
        $controller = $this
            ->getContainer()
            ->get('CustomerController');
        $response = json_decode($controller->listAllCustomers(), true);

        $this->assertArrayHasKey('data', $response);
        $this->assertArrayHasKey('status', $response);
        $this->assertEquals(200, $response['status']);
        $this->assertEquals(true, is_array($response['data']));
    }

    public function testGetCustomerById() : void
    {
        $controller = $this
            ->getContainer()
            ->get('CustomerController');
        $customer = new Customer();
        $customer->id = 1;
        $customer->name = 'João da Silva';
        $customer->cpf = '123.456.789-00';
        $customer->phone = '(44) 99999-9999';
        $customer->email = 'joao@mail.com';
        unset($customer->password);

        $this->assertEquals(
            json_encode(['data' => $customer, 'status' => 200]),
            $controller->getCustomerById($customer->id)
        );
    }

    public function testGetCustomerByIdWithInvalidId() : void
    {
        $controller = $this
            ->getContainer()
            ->get('CustomerController');

        $this->assertEquals(
            json_encode(['data' => 'Cliente não encontrado.', 'status' => 404]),
            $controller->getCustomerById(0)
        );
    }

    public function testLoginSuccess() : void
    {
        $controller = $this
            ->getContainer()
            ->get('CustomerController');
        $data = ['email' => 'joao@mail.com', 'password' => 'secret'];
        $customer = new Customer();
        $customer->id = 1;
        $customer->name = 'João da Silva';
        $customer->cpf = '123.456.789-00';
        $customer->phone = '(44) 99999-9999';
        $customer->email = 'joao@mail.com';
        unset($customer->password);

        $this->assertEquals(
            json_encode(['data' => $customer, 'status' => 200]),
            $controller->login($data)
        );
    }

    public function testLoginWithIncorrectEmail() : void
    {
        $controller = $this
            ->getContainer()
            ->get('CustomerController');
        $data = ['email' => 'jose@mail.com', 'password' => 'secret'];

        $this->assertEquals(
            json_encode(['data' => 'Credenciais Inválidas', 'status' => 401]),
            $controller->login($data)
        );
    }

    public function testLoginWithInvalidEmail() : void
    {
        $controller = $this
            ->getContainer()
            ->get('CustomerController');
        $data = ['email' => 'jose@mail', 'password' => 'secret'];

        $this->assertEquals(
            json_encode(['data' => 'Formato de e-mail inválido.', 'status' => 422]),
            $controller->login($data)
        );
    }

    public function testLoginWithEmptyEmailParam() : void
    {
        $controller = $this
            ->getContainer()
            ->get('CustomerController');
        $data = ['email' => '', 'password' => 'secret'];

        $this->assertEquals(
            json_encode(['data' => 'O campo E-mail é obrigatório.', 'status' => 422]),
            $controller->login($data)
        );
    }

    public function testLoginWithoutEmailParam() : void
    {
        $controller = $this
            ->getContainer()
            ->get('CustomerController');
        $data = ['password' => 'secret'];

        $this->assertEquals(
            json_encode(['data' => 'O campo E-mail é obrigatório.', 'status' => 422]),
            $controller->login($data)
        );
    }

    public function testLoginWithInvalidPassword() : void
    {
        $controller = $this
            ->getContainer()
            ->get('CustomerController');
        $data = ['email' => 'joao@mail.com', 'password' => '123456'];

        $this->assertEquals(
            json_encode(['data' => 'Credenciais Inválidas', 'status' => 401]),
            $controller->login($data)
        );
    }

    public function testLoginWithEmptyPasswordParam() : void
    {
        $controller = $this
            ->getContainer()
            ->get('CustomerController');
        $data = ['email' => 'joao@mail.com', 'password' => ''];

        $this->assertEquals(
            json_encode(['data' => 'O campo Senha é obrigatório.', 'status' => 422]),
            $controller->login($data)
        );
    }

    public function testLoginWithoutPasswordParam() : void
    {
        $controller = $this
            ->getContainer()
            ->get('CustomerController');
        $data = ['email' => 'joao@mail.com'];

        $this->assertEquals(
            json_encode(['data' => 'O campo Senha é obrigatório.', 'status' => 422]),
            $controller->login($data)
        );
    }

    public function testLoginWithoutAnyParam() : void
    {
        $controller = $this
            ->getContainer()
            ->get('CustomerController');
        $data = [];

        $this->assertEquals(
            json_encode(['data' => 'O campo E-mail é obrigatório.', 'status' => 422]),
            $controller->login($data)
        );
    }
}
