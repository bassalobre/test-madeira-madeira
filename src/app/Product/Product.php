<?php

namespace TesteMadeiraMadeira\Product;

use TesteMadeiraMadeira\Core\ModelContract;

class Product implements ModelContract
{

    public $id;
    public $name;
    public $description;
    public $price;

    public function setModel(object $object) : void
    {
        $this->id = (int) $object->id;
        $this->name = (string) $object->name;
        $this->description = (string) $object->description;
        $this->price = (float) $object->price;
    }
}
