<?php

namespace TesteMadeiraMadeira\Order;

use TesteMadeiraMadeira\Core\ModelContract;
use TesteMadeiraMadeira\Core\RepositoryContract;
use TesteMadeiraMadeira\Core\ServiceContract;

class OrderService implements ServiceContract
{
    private $repository;
    private $customerService;
    private $productService;

    public function __construct(
        RepositoryContract $repository,
        ServiceContract $customerService,
        ServiceContract $productService
    )
    {
        $this->repository = $repository;
        $this->customerService = $customerService;
        $this->productService = $productService;
    }

    public function listAllOrders() : array
    {
        return $this
            ->repository
            ->getAllOrders();
    }

    public function getOrderById(int $id) :? ModelContract
    {
        $order = $this
            ->repository
            ->getOrderById($id);

        if ($order) {
            $order = $this->setCustomerOnOrder($order);
            $order = $this->addProductsOnOrder($order);
        }

        return $order;
    }

    private function setCustomerOnOrder(ModelContract $order) : ModelContract
    {
        $customer = $this
            ->customerService
            ->getCustomerById($order->customer_id);

        $order->setCustomer($customer);

        return $order;
    }

    private function addProductsOnOrder(ModelContract $order) : ModelContract
    {
        $products = $this
            ->repository
            ->getAllOrderProductsByOrderId($order->id);

        array_map(function ($item) use($order) {
            $product = $this
                ->productService
                ->getProductById($item->product_id);

            $order->addProduct($product);
        }, $products);

        return $order;
    }
}
