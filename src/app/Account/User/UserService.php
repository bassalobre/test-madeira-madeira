<?php

namespace TesteMadeiraMadeira\Account\User;

use TesteMadeiraMadeira\Core\Repository\RepositoryContract;
use TesteMadeiraMadeira\Core\Service\ServiceContract;

class UserService implements ServiceContract
{

    private $repository;

    public function __construct(RepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function login(array $data)
    {
        $user = $this
            ->repository
            ->getUserByLogin($data['login']);

        if ($user && password_verify($data['password'], $user->password)) {
            unset($user->login);
            unset($user->password);

            return $user;
        }

        return null;
    }
}
