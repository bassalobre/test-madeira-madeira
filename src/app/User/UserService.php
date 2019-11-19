<?php

namespace TesteMadeiraMadeira\User;

use TesteMadeiraMadeira\Core\ModelContract;
use TesteMadeiraMadeira\Core\RepositoryContract;
use TesteMadeiraMadeira\Core\ServiceContract;

class UserService implements ServiceContract
{
    private $repository;

    public function __construct(RepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function login(array $data) :? ModelContract
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
