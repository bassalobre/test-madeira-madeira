<?php

namespace TesteMadeiraMadeira\Customer;

use TesteMadeiraMadeira\Core\ModelContract;

class Customer implements ModelContract
{

    public $id;
    public $name;
    public $cpf;
    public $phone;
    public $email;
    public $password;

    public function setModel(object $object) : void
    {
        $this->id = (int) $object->id;
        $this->name = (string) $object->name;
        $this->cpf = (string) $object->cpf;
        $this->phone = (string) $object->phone;
        $this->email = (string) $object->email;
        $this->password = (string) $object->password;
    }
}
