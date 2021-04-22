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
    protected $price;
    /**
     * @var int
     */
    protected $count;

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
class SpoiledTurnips implements TurnipsContract
{
    /**
     * @var int
     */
    protected $price;
    /**
     * @var int
     */
    protected $count;

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

final class TurnipsFactory
{
    /**
     * @param string $type
     * @param int $price
     * @param int $count
     * 
     * @return TurnipsContract
     */

    public static function factory(string $type, int $price, int $count):TurnipsContract
    {
        if( $type === '大頭菜' ){
            return new Turnips($price,$count);
        }
        
        if( $type === '壞掉的大頭菜' ){
            return new SpoiledTurnips($price,$count);
        }
        
        throw new \InvalidArgumentException('找不到這種大頭菜');
    }
}
