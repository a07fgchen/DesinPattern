<?php

use App\Order;

class ContextOrder extends StateOrder
{
    public function getState():StateOrder
    {
        return static::$state;
    }
    
    public function setState(StateOrder $state)
    {
        static::$state = $state;
    }

    public function done()
    {
        static::$state->done();
    }

    public function getStatus():string
    {
        return static::$state->getStatus();
    }
}


abstract class StateOrder
{
    /**
     * @var array
     */
    private $detaials;
    
    /**
     * @var StateOrder $state
     */
    protected static $state;

    /**
     * @return mixed
     */
    abstract protected function done();

    protected function setStatus(string $status)
    {
        $this->detaials['status'] = $status;
        $this->detaials['updatedTime'] = time();
    }
    
    protected function getStatus():string
    {
        return $this->detaials['status'];
    }
}

class ShippingOrder extends StateOrder
{
    public function __construct()
    {
        $this->setStatus('shipping');
    }
    
    public function done()
    {
        $this->setStatus('completed');
    }
}

class CreateOrder extends StateOrder
{
    public function __construct()
    {
        $this->setStatus('created');
    }

    public function done()
    {
        static::$state = new ShippingOrder();
    }

}

$order = new CreateOrder();
$contextOrder = new ContextOrder();
$contextOrder->setState($order);
$contextOrder->done;
var_dump(
    $contextOrder->getStatus()
);