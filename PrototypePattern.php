<?php

abstract class TurnipsPrototype
{
    /**
     * @var string
     */
    protected string $category;

    /**
     * @var int
     */
    protected int $price;

    /**
     * @var int
     */
    protected int $count;

    abstract public function __clone();

    /**
     * set price
     */
    public function setPrice($price):void
    {
        $this->price = $price;
    }
    /**
     * set count
     */
    public function setCount($count):void
    {
        $this->count = $count;
    }
    /**
     * @return int
     */
    public function calculationPrice(): int
    {
        if (
            isset($this->price) &&
            isset($this->count)
        ) {
            return $this->price * $this->count;
        }
        return 0;
    }
}

class Turnips extends TurnipsPrototype
{
    /**
     * @var string 
     */
    protected string $category = '大頭菜';

    /**
     * Turnips constructot.
     * 
     * @param int $price
     * @param int $count
     */
    public function __construct(int $price, int $count)
    {
        $this->price = $price;
        $this->count = $count;
    }

    /**
     * 
     */
    public function __clone()
    {
    }
}

class SpoiledTurnips extends TurnipsPrototype
{
    /**
     * @var string
     */
    protected string $category = "壞掉的大頭菜";

    /**
     * @var int
     */
    const SPOILED_PRICE = 0;

    /**
     * SpoiledTurnips constructor.
     * 
     * @param int $price
     * @param int $count
     */
    public function __construct(int $price, int $count)
    {
        $this->price = self::SPOILED_PRICE;
        $this->count = $count;
    }
    /**
     * clone
     */
    public function __clone()
    {
    }
}
try {
    $turnips = new Turnips(100, 40);
    echo $turnips->calculationPrice().PHP_EOL;
    $clone = clone $turnips;
    $clone->setPrice(400);
    echo $clone->calculationPrice().PHP_EOL;
} catch (\Throwable $th) {
    echo $th->getMessage();
    //throw $th;
}