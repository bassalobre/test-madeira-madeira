<?php

namespace TesteMadeiraMadeira\Tests\Order;

use TesteMadeiraMadeira\Customer\Customer;
use TesteMadeiraMadeira\Order\Order;
use TesteMadeiraMadeira\Product\Product;
use TesteMadeiraMadeira\Tests\TestCase;

class OrderControllerTest extends TestCase
{

    public function testListAllOrders() : void
    {
        $controller = $this
            ->getContainer()
            ->get('OrderController');
        $response = json_decode($controller->listAllOrders(), true);

        $this->assertArrayHasKey('data', $response);
        $this->assertArrayHasKey('status', $response);
        $this->assertEquals(200, $response['status']);
        $this->assertEquals(true, is_array($response['data']));
    }

    public function testGetOrderById() : void
    {
        $controller = $this
            ->getContainer()
            ->get('OrderController');

        $customer = new Customer();
        $customer->id = 1;
        $customer->name = 'João da Silva';
        $customer->cpf = '123.456.789-00';
        $customer->phone = '(44) 99999-9999';
        $customer->email = 'joao@mail.com';
        unset($customer->password);

        $productOne = new Product();
        $productOne->id = 1;
        $productOne->name = 'Cama';
        $productOne->description = 'Cama box casal King';
        $productOne->price = 1500;

        $productTwo = new Product();
        $productTwo->id = 2;
        $productTwo->name = 'Televisão';
        $productTwo->description = 'Televisão Samgsung 50 Smart';
        $productTwo->price = 1799.99;

        $order = new Order();
        $order->id = 1;
        $order->customer_id = $customer->id;
        $order->price = ($productOne->price + $productTwo->price);
        $order->created_at = '2019-11-19 22:00:00';
        $order->setCustomer($customer);
        $order->addProduct($productOne);
        $order->addProduct($productTwo);

        $this->assertEquals(
            json_encode(['data' => $order, 'status' => 200]),
            $controller->getOrderById($order->id)
        );
    }

    public function testGetOrderByIdWithInvalidId() : void
    {
        $controller = $this
            ->getContainer()
            ->get('OrderController');

        $this->assertEquals(
            json_encode(['data' => 'Pedido não encontrado.', 'status' => 404]),
            $controller->getOrderById(0)
        );
    }
}
