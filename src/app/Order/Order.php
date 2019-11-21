<?php

namespace TesteMadeiraMadeira\Order;

use TesteMadeiraMadeira\Core\ModelContract;
use TesteMadeiraMadeira\Customer\Customer;
use TesteMadeiraMadeira\Product\Product;

class Order implements ModelContract
{

    public $id;
    public $customer_id;
    public $price;
    public $created_at;

    public $customer;
    public $products = [];

    public function setModel(object $object) : void
    {
        $this->id = (int) $object->id;
        $this->customer_id = (int) $object->customer_id;
        $this->price = (float) $object->price;
        $this->created_at = date($object->created_at);
    }

    public function setCustomer(Customer $customer) : void
    {
        $this->customer = $customer;
    }

    public function addProduct(Product $product) : void
    {
        array_push($this->products, $product);
    }
}
