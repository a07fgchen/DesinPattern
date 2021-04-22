<?php
include_once './AbstractFactory.php';

use PHPUnit\Framework\TestCase;

class AbstractFactoryTest extends TestCase
{
    /**
     * 測試是否能夠建立大頭菜
     */
    public function test_can_create_turnips()
    {
        $factory = new TurnipsFactory();
        $turips = $factory->createTurnips('大頭菜',100,40);
        
        $this->assertInstanceOf(Turnips::class,$turips);
    }
    /**
     * 測試是否能夠建立換掉的大頭菜
     * 
     * @test
     */
    public function test_can_create_spoiled_turnips()
    {
        $factory = new SpoiledTurnipsFactory();
        $turips = $factory->createTurnips('壞掉的大頭菜',100,40);
        
        $this->assertInstanceOf(SpoiledTurnips::class,$turips);
    }
    /**
     * 測試大頭菜是否能夠正常計算價格。
     * 
     * @test
     */
    public function test_can_calculate_price_for_turnips()
    {
        $factory = new TurnipsFactory();
        $turips = $factory->createTurnips("大頭菜",100,40);
        
        $this->assertEquals(4000,$turips->calculatePrice());
    }

    /**
     * 測試壞掉的大頭菜是否正常計算價格
     * 
     * @test
     */
    public function test_can_calculate_price_for_spoiled_turnips()
    {
        $factory = new SpoiledTurnipsFactory();
        $turips = $factory->createTurnips("壞掉的大頭菜",100,40);

        $this->assertEquals(4000,$turips->calculatePrice());
    }
}