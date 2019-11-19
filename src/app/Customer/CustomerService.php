<?php

namespace TesteMadeiraMadeira\Customer;

use TesteMadeiraMadeira\Core\ModelContract;
use TesteMadeiraMadeira\Core\RepositoryContract;
use TesteMadeiraMadeira\Core\ServiceContract;

class CustomerService implements ServiceContract
{
    private $repository;

    public function __construct(RepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function listAllCustomers() : array
    {
        return $this
            ->repository
            ->getAllCustomers();
    }

    public function getCustomerById(int $id) :? ModelContract
    {
        $customer = $this
            ->repository
            ->getCustomerById($id);
        unset($customer->password);

        return $customer;
    }

    public function login(array $data) :? ModelContract
    {
        $customer = $this
            ->repository
            ->getCustomerByEmail($data['email']);

        if ($customer && password_verify($data['password'], $customer->password)) {
            unset($customer->password);
            return $customer;
        }

        return null;
    }
}
