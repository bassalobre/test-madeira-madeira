<?php

namespace TesteMadeiraMadeira\Account;

use TesteMadeiraMadeira\Core\Service\ServiceContract;

class AuthController
{

    private $userService;

    public function __construct(ServiceContract $userService)
    {
        $this->userService = $userService;
    }

    public function login(array $data)
    {
        $validate = $this->validateRequest($data);

        if (!$validate['isValid']) {
            return json_encode(['data' => $validate['message'], 'status' => 422]);
        }

        $login = $this
            ->userService
            ->login($data);

        if (!$login) {
            return json_encode(['data' => 'Credenciais Inválidas', 'status' => 401]);
        }

        return json_encode(['data' => $login, 'status' => 200]);
    }

    private function validateRequest(array $data) : array
    {
        if (!array_key_exists('login', $data) || !$data['login']) {
            return [
                'isValid' => false,
                'message' => 'O campo Usuário é obrigatório.',
            ];
        }

        if (!array_key_exists('password', $data) || !$data['password']) {
            return [
                'isValid' => false,
                'message' => 'O campo Senha é obrigatório.',
            ];
        }

        return [
            'isValid' => true,
        ];
    }
}
