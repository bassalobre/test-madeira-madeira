<?php

namespace TesteMadeiraMadeira\Account\User;

use TesteMadeiraMadeira\Core\ModelContract;

class User implements ModelContract
{

    public $id;
    public $name;
    public $login;
    public $password;

    public function setModel(object $object) : void
    {
        $this->id = (int) $object->id;
        $this->name = (string) $object->name;
        $this->login = (string) $object->login;
        $this->password = (string) $object->password;
    }
}
