<?php

class Item
{
    /**
     * @var float
     */
    private $price;

    public function __construct(float $price)
    {
        $this->price = $price;
    }

    public function getPrice(): float
    {
        return $this->price;
    }
}

interface SpecificationInterface
{
    public function isSatisfiedBy(Item $item): bool;
}

class OrSpecification implements SpecificationInterface
{
    /**
     * @var SpecificcationInterface[]
     */
    private $specifications;

    /**
     * @var SpecificcationInterface[] ...$specification
     */
    public function __construct(SpecificcationInterface ...$specifications)
    {
        $this->specifications = $specifications;
    }

    /**
     * 如果有一條規則符合條件,返回true,否則返回false
     */
    public function isSatisfiedBy(Item $item): bool
    {
        foreach ($this->specifications as $specification) {
            if ($specification->isSatisfiedBy($item)) {
                return true;
            }
        }

        return false;
    }
}

class PriceSpecification implements SpecificationInterface
{
    /**
     * @var float|null
     */
    private $maxPrice;

    /**
     * @var float|null
     */
    private $minPrice;

    /**
     * @param float $minPrice
     * @param float $maxPrice
     */
    public function __construct(int $minPrice, int $maxPrice)
    {
        $this->minPrice = $minPrice;
        $this->maxPrice = $maxPrice;
    }

    public function isSatisfiedBy(Item $item): bool
    {
        if (
            $this->maxPrice !== null &&
            $item->getPrice() > $this->maxPrice
        ) {
            return false;
        }
        if (
            $this->minPrice !== null &&
            $item->getPrice() < $this->minPrice
        ) {
            return false;
        }
        return true;
    }
}

class AndSpecification implements SpecificationInterface
{
    /**
     * @var SpecificationInterface[]
     */
    private $specifications;

    /**
     * @param SpecificationInterface[] ...$specifications
     */
    public function __construct(SpecificationInterface ...$specifications)
    {
        $this->specifications = $specifications;
    }

    /**
     * 如果有跳規則不符合條件,返回false,否則返回true
     */
    public function isSatisfiedBy(Item $item): bool
    {
        foreach ($this->specifications as $specification) {
            if (!$specification->isSatisfiedBy($item)) {
                return false;
            }
        }

        return true;
    }
}

class NotSpecification implements SpecificationInterface
{
    /**
     * @var SpecificationInterface
     */
    private $specification;

    public function __construct(SpecificationInterface $specification)
    {
        $this->specification = $specification;
    }

    public function isSatisfiedBy(Item $item): bool
    {
        return !$this->specification->isSatisfiedBy($item);
    }
}

$spec1 = new PriceSpecification(50, 100);
$noSpec = new NotSpecification($spec1);
echo "<pre>";
var_dump($noSpec->isSatisfiedBy(new Item(150)));
var_dump($noSpec->isSatisfiedBy(new Item(50)));
