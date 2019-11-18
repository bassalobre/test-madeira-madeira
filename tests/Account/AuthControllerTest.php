<?php

namespace TesteMadeiraMadeira\Tests\Account;

use stdClass;
use TesteMadeiraMadeira\Tests\TestCase;

class AuthControllerTest extends TestCase
{

    public function testLogin() : void
    {
        $controller = $this->getContainer()->get('TesteMadeiraMadeira\Account\AuthController');
        $data = ['login' => 'bassalobre', 'password' => 'secret'];
        $user = new stdClass();
        $user->id = 1;
        $user->name = 'William Bassalobre';

        $this->assertEquals(
            json_encode(['data' => $user, 'status' => 200]),
            $controller->login($data)
        );
    }
}
