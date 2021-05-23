<?php

class Context
{
    /**
     * @var ComparatorInterface
     */
    private $comparator;

    public function __construct(ComparatorInterface $comparator)
    {
        $this->comparator = $comparator;
    }

    public function executeStrategy(array $element):array
    {
        uasort($element,[$this->comparator,'compare']);

        return $element;
    }
}

interface ComparatorInterface
{
    /**
     * @param mixed $a
     * @param mixed $b
     * 
     * @return int
     */
    public function compare($a,$b):int;
}

class DateComparator implements ComparatorInterface
{
    public function compare($a, $b): int
    {
        $DateA = new \DateTime($a['date']);
        $DateB = new \DateTime($b['date']);
        
        return $DateA <=> $DateB;
    }
}