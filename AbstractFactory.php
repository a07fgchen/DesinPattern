<?php

/**
 * Interface TurnipsContract
 */
interface TurnipsContract
{
    public function calculatePrice(): int;
}


class Turnips implements TurnipsContract
{
    /**
     * @var int
     */
    protected int $price;
    /**
     * @var int
     */
    protected int $count;
    /**
     * Turnips constructor
     */
    public function __construct(int $price, int $count)
    {
        $this->price = $price;
        $this->count = $count;
    }

    /**
     * @return int
     */
    public function calculatePrice(): int
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

/**
 * Class SpoiledTurnips
 */
class SpoiledTurnips implements TurnipsContract
{
    /**
     * @var int
     */
    protected int $price;

    /**
     * @var int
     */
    protected int $count;

    /**
     * SpoiledTurnips constructor
     */
    public function __construct(int $price, int $count)
    {
        $this->price = $price;
        $this->count = $count;
    }
    /**
     * @return int
     */
    public function calculatePrice(): int
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


interface FactoryContract
{
    public function createTurnips(string $type,int $price,int $count):TurnipsContract;
}

/**
 * Class BaseFactory
 */

abstract class BaseFactory implements FactoryContract
{
    /**
     * @param string $type
     * @param int $price
     * @param int $count
     * 
     * @return TurnipsContract
     */
    public function createTurnips(string $type,int $price, int $count): TurnipsContract
    {
        if( $type==="大頭菜" ){
            return new Turnips($price,$count);
        }
        
        if($type==="壞掉的大頭菜"){
            return new SpoiledTurnips($price,$count);
        }

        throw new \InvalidArgumentException('找不到這種大頭菜分類');
    }
}

class TurnipsFactory extends BaseFactory
{
    
}

class SpoiledTurnipsFactory extends BaseFactory
{
    
}