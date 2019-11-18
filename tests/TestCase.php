<?php

namespace TesteMadeiraMadeira\Tests;

use DI\Container;
use DI\ContainerBuilder;
use PHPUnit\Framework\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{

    protected function getContainer() : Container
    {
        $builder = new ContainerBuilder();
        $builder->useAnnotations(true);

        return $builder->build();
    }
}
