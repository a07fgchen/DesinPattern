<?php
include_once "./PrototypePattern.php";

use PHPUnit\Framework\TestCase;

/**
 * Class PrototypePatternTest
 */
class PrototypePatternTest extends TestCase
{
    /**
     * 建立大頭菜,並且複製10次
     * 檢查每次的大頭菜是否都是大頭菜,爾且價格正常
     * 
     * @test
     */
    public function test_can_clone_turnips()
    {
        $turnips = new Turnips(100, 40);
        for ($i = 0; $i < 10; $i++) {
            $clone = clone $turnips;

            $this->assertInstanceOf(Turnips::class, $clone);
            $this->assertEquals(4000, $clone->calculationPrice());
        }
    }
    /**
     * 建立壞掉的大頭菜,並且複製10次,
     * 檢查每次大頭菜事都是壞掉的大頭菜,爾且都賣不了錢
     * 
     * @test
     */
    public function test_can_clone_spoiled_turnips()
    {
        $turnips = new SpoiledTurnips(100,40);
        for($i=0;$i<10;$i++){
            $clone = new SpoiledTurnips(100,40);
            $this->assertInstanceOf(SpoiledTurnips::class,$clone);
            $this->assertEquals(0,$clone->calculationPrice());
        }
    }
}
