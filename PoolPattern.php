<?php

use Countable;

class Turnips
{
    /**
     * @var int
     */
    protected $price;

    /**
     * @var int
     */
    protected $count;

    /**
     * Turnips constructor.
     * 
     * @param int $price
     * @param int $count
     * 
     */
    public  function __construct(int $price,int $count)
    {
        $this->price = $price;
        $this->count = $count;
    }

    /**
     * @return int
     */
    public function calculatePrice():int
    {
        if( 
            isset($this->price)&&
            isset($this->count)
         ){
             return $this->price * $this->count;
         }
         return 0;
    }
}

class Pool implements Countable
{
    /**
     * @var Turnips[]
     */
    protected $pool = [];
    /**
     * @var int
     */
    protected $total = 0;
    /**
     * @return Turnips
     */
    public function get(string $key = null):Turnips
    {
        if( $key )
        {
            $turnips = $this->pool[$key];
            unset($this->pool[$key]);
        }else{
            $turnips = array_pop($this->pool);
        }

        $this->total -= $turnips->calculatePrice();
        
        return $turnips;
    }
    /**
     * 把大頭菜塞到池子裡
     * 
     * @param  Turnips $turnips
     * 
     * @return string
     */
    public function set(Turnips $turnips):string
    {
        $key = spl_object_hash($turnips);
        $this->total += $turnips->calculatePrice();
        $this->pool[$key] = $turnips;

        return $key;
    }
    /**
     * @return int
     */
    public function total():int
    {
        return $this->total;
    }
    /**
     * @return int
     */
    public function count()
    {
        return count($this->pool);
    }
}

$pool = new Pool();

for($i=0;$i<10;$i++)
{
    $turnips = new Turnips(100,40);
    $pool->set($turnips);
}
$turnips1 = $pool->get();
$turnips2 = $pool->get();
echo "<pre>";
var_dump(
    $turnips1,
    $turnips2
);