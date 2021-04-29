<?php

namespace Design\Composite;

class InputElement extends Renderable
{
    public function __construct( string $text)
    {
        
    }

    public function render():string
    {
        return $this->text;
    }
}