<?php
include_once 'Turnips.php';
use PHPUnit\Framework\TestCase;


class SingletonPatternTest extends TestCase
{
    public function test_uniqueness()
    {
        $turnipsA = Turnips::getTurnips();
        $turnipsB = Turnips::getTurnips();
        
        $this->assertInstanceOf(Turnips::class,$turnipsA);
        $this->assertInstanceOf(Turnips::class,$turnipsB);
        $this->assertSame($turnipsA,$turnipsB);
    }
}