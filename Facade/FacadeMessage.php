<?php

interface IMessage
{
    public function push();
}

class LineSDK implements IMessage
{
    public function push()
    {
        var_dump('I push a message to line');
    }
}

class MessageFacade
{
    private $sdk;

    public function __construct(IMessage $sdk)
    {
        $this->sdk = $sdk;
    }

    public function push()
    {
        $this->sdk->push();
    }
}

$sdk = new MessageFacade(new LineSDK);
$sdk->push();