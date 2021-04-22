<?php

use PHPUnit\Framework\TestCase;

include_once './simpleFactory.php';

class SimpleFactoryTest extends TestCase
{
    /**
     * 測試是否能夠正常建立大頭菜
     */
    public function test_can_create_turnip()
    {
        $turnips = (new TurnipsFactory())->createTurnips();
        $this->assertInstanceOf(Turnips::class,$turnips);
    }
    /**
     * 測試建立的大頭菜是否能夠用正常的價買入
     * 
     * @test
     */
    public function test_can_buy_turnip()
    {
        $turnips = (new TurnipsFactory)->createTurnips();
        $price = $turnips->buy(100,40);
        
        $this->assertEquals(4000,$price);
    }
    /**
     * 測試建立大頭菜是否能夠正常的計算價格
     * 
     * @test
     */
    public function test_can_calculate_price()
    {
        $turnips = (new TurnipsFactory())->createTurnips();
        $turnips->buy(100,40);
        $price = $turnips->calculatePrice();

        $this->assertEquals(4000,$price);
    }
}