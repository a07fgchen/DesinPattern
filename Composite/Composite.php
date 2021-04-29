<?php

namespace Design\Composite;

class Form implements Renderable
{
    private array $elements;
    
    public function render(): string
    {
        $formCode = "<form>";

        foreach($this->element as $element)
        {
            $formCode .= $element->render();
        }
        return $formCode . $element;
    }

    public function addElement(Renderable $element)
    {
        $this->elements[] = $element;
    }
}