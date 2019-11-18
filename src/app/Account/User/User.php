<?php

namespace TesteMadeiraMadeira\Account\User;

use TesteMadeiraMadeira\Core\ModelContract;

class User implements ModelContract
{

    private $id;
    private $name;
    private $login;
    private $password;

    public function setModel(object $object) : void
    {
        $this->id = (int) $object->id;
        $this->name = (string) $object->name;
        $this->login = (string) $object->login;
        $this->password = (string) $object->password;
    }

    public function getModel() : object
    {
        $user = new \stdClass();
        $user->id = $this->id;
        $user->name = $this->name;
        $user->login = $this->login;
        $user->password = $this->password;

        return $user;
    }
}
