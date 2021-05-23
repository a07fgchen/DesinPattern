<?php

use SebastianBergmann\Template\Template;

abstract class Journey
{
    /**
     * @var string[]
     */
    private $thingsToDo = [];

    /**
     * 
     */
    final public function takeATrip()
    {
        $this->thingsToDo[] = $this->buyAFlight();
        $this->thingsToDo[] = $this->takePlane();
        $this->thingsToDo[] = $this->enjoyVacation();
        $buyGift = $this->buyGift();

        if($buyGift !== null){
            $this->thingsToDo[] = $buyGift;
        }
    }

    /**
     * 這麼方法必須實現,此模式的關鍵點
     */
    abstract protected function enjoyVacation():string;
    
    /**
     * 這個方法式可選的
     * 
     * @return  null|string
     */
    protected function buyGift()
    {
        return null;
    }

    private function buyAFlight():string
    {
        return "Buy a flight ticket";
    }

    private function takePlane():string
    {
        return 'Taking the plane';
    }

    /**
     * @return string[]
     */
    public function getThingToDO():array
    {
        return $this->thingsToDo;
    }
}

class BeachJourney extends Journey
{
    protected function enjoyVacation(): string
    {
        return 'Swimming and sun-bathing';
    }
}

class CityJourney extends Journey
{
    protected function enjoyVacation(): string
    {
        return "Eat ,drink,take photos and sleep";
    }

    protected function buyGift():string
    {
        return "Buy a gift";
    }
}

$beachJourney = new BeachJourney();
$beachJourney->takeATrip();
echo "<br>";
var_dump(
    $beachJourney->getThingToDO()
);