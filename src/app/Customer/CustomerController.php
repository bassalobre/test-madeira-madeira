<?php

namespace TesteMadeiraMadeira\Customer;

use TesteMadeiraMadeira\Core\ServiceContract;
use TesteMadeiraMadeira\Tools\Log;

class CustomerController
{
    private $service;

    public function __construct(ServiceContract $service)
    {
        $this->service = $service;
    }

    public function listAllCustomers() : string
    {
        $customers = $this
            ->service
            ->listAllCustomers();

        return json_encode(['data' => $customers, 'status' => 200]);
    }

    public function getCustomerById(int $id) : string
    {
        $customer = $this
            ->service
            ->getCustomerById($id);

        if (!$customer) {
            Log::create()->notice('CustomerController: Cliente não encontrado.', ['id' => $id]);
            return json_encode(['data' => 'Cliente não encontrado.', 'status' => 404]);
        }

        return json_encode(['data' => $customer, 'status' => 200]);
    }

    public function login(array $data) : string
    {
        $validate = $this->validateRequest($data);

        if (!$validate['isValid']) {
            Log::create()->info('CustomerController: ' . $validate['message'], $data);
            return json_encode(['data' => $validate['message'], 'status' => 422]);
        }

        $login = $this
            ->service
            ->login($data);

        if (!$login) {
            Log::create()->info('CustomerController: Credenciais Inválidas.', $data);
            return json_encode(['data' => 'Credenciais Inválidas', 'status' => 401]);
        }

        Log::create()->info('CustomerController: Cliente logado.', ['id' => $login->id, 'name' => $login->name]);
        return json_encode(['data' => $login, 'status' => 200]);
    }

    private function validateRequest(array $data) : array
    {
        if (!array_key_exists('email', $data) || !$data['email']) {
            return [
                'isValid' => false,
                'message' => 'O campo E-mail é obrigatório.',
            ];
        }

        if (!array_key_exists('password', $data) || !$data['password']) {
            return [
                'isValid' => false,
                'message' => 'O campo Senha é obrigatório.',
            ];
        }

        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            return [
                'isValid' => false,
                'message' => 'Formato de e-mail inválido.',
            ];
        }

        return [
            'isValid' => true,
        ];
    }
}
