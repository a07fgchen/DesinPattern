<?php
include_once './StaticFactory.php';

use PHPUnit\Framework\TestCase;

class StaticFactoryTest extends TestCase
{
    /**
     * 測試是否能夠正常建立大頭菜
     * 
     * @test
     */
    public function test_can_create_turnips()
    {
        $this->assertInstanceOf(Turnips::class,TurnipsFactory::factory('大頭菜',100,40));   
    }
    
    /**
     * 測試是否能夠正常建立壞店的大頭菜
     * 
     * @test
     */
    public function test_can_create_spoild_turnips()
    {
        $this->assertInstanceOf(SpoiledTurnips::class,TurnipsFactory::factory('壞掉的大頭菜',100,40));
    }
    
    /**
     * 測試是否能夠正常計算大頭菜的價格
     * @test
     */
    public function test_can_create_calculate_price_for_turnips()
    {
        $turnips = TurnipsFactory::factory('大頭菜',100,40);
    }

    /**
     * 測試是否能夠正常計算壞掉的大頭菜的價格
     */
    public function test_can_caculate_price_for_spolied_turnips()
    {
        $turnips = TurnipsFactory::factory('壞掉的大頭菜',100,40);
        
        $this->assertEquals(4000,$turnips->calculatePrice());
    }

    /**
     * 測試是否能夠收到未知的大頭菜
     * 
     * @expectedException \InvalidArgumentException
     */
    public function testException()
    {
        $this->expectException(\InvalidArgumentException::class);
        TurnipsFactory::factory('未知的大頭菜',0,0);
    }
}