<?php

namespace Design;

use Lcobucci\JWT\Builder;
use PDepend\Source\Builder\BuilderContext;

/**
 * Class Price
 */
class Price
{
    /**
     * @var int
     */
    protected int $price = 0;

    /**
     * Price constructor
     * 
     * @param int $price
     */
    public function __construct(int $price)
    {
        $this->set($price);
    }

    /**
     * @return int
     */
    public function get(): int
    {
        return $this->price;
    }

    /**
     * @param int $price
     */
    public function set(int $price)
    {
        $this->price = $price;
    }
}

/**
 * Class Count
 */
class Count
{
    /**
     * @var int
     */
    protected int $price = 0;

    /**
     * Price constructor
     * 
     * @param int $price
     */
    public function __construct(int $count)
    {
        $this->set($count);
    }
    /**
     * @return int
     */
    public function get(): int
    {
        return $this->price;
    }
    /**
     * @param int
     */
    public function set(int $price)
    {
        $this->price = $price;
    }
}

abstract class TurnipsPrototype
{
    /**
     * @var Price
     */
    protected Price $price;

    /**
     * @var Count $count
     */

    protected Count $count;

    abstract public function calculatePrice(): int;

    /**
     * @param int $price
     */
    public function setPrice(int $price)
    {
        $this->price = new Price($price);
    }
    /**
     * @param int $count
     */
    public function setCount(int $count)
    {
        $this->count = new Count($count);
    }
}

class Turnips extends TurnipsPrototype
{
    /**
     * @return int
     */
    public function calculatePrice(): int
    {
        if (
            isset($this->price) &&
            isset($this->count)
        ) {
            return $this->price->get() * $this->count->get();
        }
        return 0;
    }
}

/**
 * Class SpoiledTurnips.
 */
class SpoiledTurnips extends TurnipsPrototype
{
    /**
     * @return int
     */
    public function calculatePrice(): int
    {
        if (
            isset($this->price) &&
            isset($this->count)
        ) {
            return 0 * $this->count->get();
        }
        return 0;
    }
}

/**
 * Bulider
 */
interface BuilderContract
{
    public function createTurnips();

    public function setPrice(int $price);

    public function setCount(int $count);

    public function getTurnips(): TurnipsPrototype;
}

class TurnipsBuilder implements BuilderContract
{
    /**
     * @var Turnips
     */
    protected Turnips $turnips;

    /**
     * create Turnips
     */
    public function createTurnips()
    {
        $this->turnips = new Turnips();
    }

    /**
     * @param int $price
     */
    public function setPrice(int $price)
    {
        $this->turnips->setPrice($price);
    }

    /**
     * @param int $count
     */
    public function setCount(int $count)
    {
        $this->turnips->setCount($count);
    }
    /**
     * @return Turnips
     */
    public function setTurnips(): Turnips
    {
        return $this->turnips;
    }
    /**
     * @return Turnips
     */
    public function getTurnips(): TurnipsPrototype
    {
        return $this->turnips;
    }
}

class SpoiledTurnipsBuilder implements BuilderContract
{
    /**
     * 壞掉的大頭菜是沒辦法賣零錢的!
     */
    const SPOILED_PRICE = 0;
    /**
     * @var SpoiledTurnips
     */
    protected SpoiledTurnips $turnips;

    /**
     * 
     */
    public function createTurnips()
    {
        $this->turnips = new SpoiledTurnips();
    }
    /**
     * @param int $price
     */
    public function setPrice(int $price)
    {
        $this->turnips->setPrice($price);
    }
    /**
     * @param int $count
     */
    public function setCount(int $count)
    {
        $this->turnips->setCount($count);
    }
    /**
     * @return SpoiledTurnips
     */
    public function getTurnips():SpoiledTurnips
    {
        return $this->turnips;
    }
}

/**
 * Class Director
 */
class Director
{
    /**
     * @param BuilderContract $builder
     * @param int $price
     * @param int $count
     * 
     * @return TurnipsPrototype
     */
    public function build(BuilderContract $builder,int $price,int $count):TurnipsPrototype
    {
        $builder->createTurnips();
        $builder->setPrice($price);
        $builder->setCount($count);
        
        return $builder->getTurnips();
    }
}


$builder = new TurnipsBuilder();
$turnips = (new Director())->build($builder,100,40);
echo "<pre>";
var_dump($turnips);

echo $turnips->calculatePrice();