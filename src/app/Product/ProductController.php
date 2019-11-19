<?php

namespace TesteMadeiraMadeira\Product;

use TesteMadeiraMadeira\Core\ServiceContract;
use TesteMadeiraMadeira\Tools\Log;

class ProductController
{
    private $service;

    public function __construct(ServiceContract $service)
    {
        $this->service = $service;
    }

    public function listAllProducts() : string
    {
        $products = $this
            ->service
            ->listAllProducts();

        return json_encode(['data' => $products, 'status' => 200]);
    }

    public function getProductById(int $id) : string
    {
        $product = $this
            ->service
            ->getProductById($id);

        if (!$product) {
            Log::create()->notice('ProductController: Produto não encontrado.', ['id' => $id]);
            return json_encode(['data' => 'Produto não encontrado.', 'status' => 404]);
        }

        return json_encode(['data' => $product, 'status' => 200]);
    }
}
