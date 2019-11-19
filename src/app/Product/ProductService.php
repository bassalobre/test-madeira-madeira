<?php

namespace TesteMadeiraMadeira\Product;

use TesteMadeiraMadeira\Core\ModelContract;
use TesteMadeiraMadeira\Core\RepositoryContract;
use TesteMadeiraMadeira\Core\ServiceContract;

class ProductService implements ServiceContract
{
    private $repository;

    public function __construct(RepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function listAllProducts() : array
    {
        return $this
            ->repository
            ->getAllProducts();
    }

    public function getProductById(int $id) :? ModelContract
    {
        return $this
            ->repository
            ->getProductById($id);
    }
}
