<?php

namespace TesteMadeiraMadeira\Tests\Product;

use TesteMadeiraMadeira\Product\Product;
use TesteMadeiraMadeira\Tests\TestCase;

class ProductControllerTest extends TestCase
{

    public function testListAllProducts() : void
    {
        $controller = $this
            ->getContainer()
            ->get('ProductController');
        $response = json_decode($controller->listAllProducts(), true);

        $this->assertArrayHasKey('data', $response);
        $this->assertArrayHasKey('status', $response);
        $this->assertEquals(200, $response['status']);
        $this->assertEquals(true, is_array($response['data']));
    }

    public function testGetProductById() : void
    {
        $controller = $this
            ->getContainer()
            ->get('ProductController');
        $product = new Product();
        $product->id = 1;
        $product->name = 'Cama';
        $product->description = 'Cama box casal King';
        $product->price = 1500;

        $this->assertEquals(
            json_encode(['data' => $product, 'status' => 200]),
            $controller->getProductById($product->id)
        );
    }

    public function testGetProductByIdWithInvalidId() : void
    {
        $controller = $this
            ->getContainer()
            ->get('ProductController');

        $this->assertEquals(
            json_encode(['data' => 'Produto não encontrado.', 'status' => 404]),
            $controller->getProductById(0)
        );
    }
}
