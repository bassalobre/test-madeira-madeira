<?php

namespace TesteMadeiraMadeira\User;

use TesteMadeiraMadeira\Core\ServiceContract;
use TesteMadeiraMadeira\Tools\Log;

class UserController
{
    private $userService;

    public function __construct(ServiceContract $userService)
    {
        $this->userService = $userService;
    }

    public function login(array $data) : string
    {
        $validate = $this->validateRequest($data);

        if (!$validate['isValid']) {
            Log::create()->info('UserController: ' . $validate['message'], $data);
            return json_encode(['data' => $validate['message'], 'status' => 422]);
        }

        $login = $this
            ->userService
            ->login($data);

        if (!$login) {
            Log::create()->info('UserController: Credenciais Inválidas.', $data);
            return json_encode(['data' => 'Credenciais Inválidas', 'status' => 401]);
        }

        Log::create()->info('UserController: Usuário logado.', ['id' => $login->id, 'name' => $login->name]);
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
