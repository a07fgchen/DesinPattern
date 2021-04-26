<?php

namespace RefactoringGuru\Bridge\Concetual;

class Abstraction
{
    protected $implementation;
    
    public function __construct(Implementation $implementation)
    {
        $this->implementation = $implementation;
    }

    public function operation():string
    {
        return $this->implementation->operationImplementation();
    }
}

class ExtendedAbstraction extends Abstraction
{
   
}

interface Implementation
{
    public function operationImplementation():string;
}

class ConcreateImplementationA implements Implementation
{
    public function operationImplementation(): string
    {
        return "ConcreateImplementA";
    }
}

class ConcreateImplementationB implements Implementation
{
    public function operationImplementation(): string
    {
       return "ConcreateImplementB";
    }
}

function clientCode(Abstraction $abstraction)
{
    echo $abstraction->operation();
}

$implementationA = new ConcreateImplementationA();
$abstraction = new Abstraction($implementationA);
