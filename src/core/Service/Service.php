<?php

namespace TesteMadeiraMadeira\Core\Service;

use TesteMadeiraMadeira\Core\Repository\RepositoryContract;

abstract class Service
{

    protected $repository;

    public function __construct(RepositoryContract $repository)
    {
        $this->repository = $repository;
    }
}
