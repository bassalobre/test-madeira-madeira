<?php

namespace TesteMadeiraMadeira\Order;

use TesteMadeiraMadeira\Core\ServiceContract;
use TesteMadeiraMadeira\Tools\Log;

class OrderController
{
    private $service;

    public function __construct(ServiceContract $service)
    {
        $this->service = $service;
    }

    public function listAllOrders() : string
    {
        $orders = $this
            ->service
            ->listAllOrders();

        return json_encode(['data' => $orders, 'status' => 200]);
    }

    public function getOrderById(int $id) : string
    {
        $order = $this
            ->service
            ->getOrderById($id);

        if (!$order) {
            Log::create()->notice('OrderController: Pedido não encontrado.', ['id' => $id]);
            return json_encode(['data' => 'Pedido não encontrado.', 'status' => 404]);
        }

        return json_encode(['data' => $order, 'status' => 200]);
    }
}
