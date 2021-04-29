<?php

namespace Design\Dependency;

use PHPUnit\Framework\TestCase;

class DependencyTest extends TestCase
{
    public function testDependencyInjection()
    {
        $config = new DatabaseConfiguration('localhost',3306,'domnikl','1234');

        $connection = new DatabaseConnection($config);

        $this->assertEquals("domnikl:1234@localhost::3306",$connection->getDsn());
    }
}