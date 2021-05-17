<?php

class Service
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * 做些甚麼...
     * 在日記中返回了 '我們在service dosomething'.
     */
    public function doSomething()
    {

        $this->logger->log('We are in ' . __METHOD__);
    }
}

interface LoggerInterface
{
    public function log(string $str);
}

class PrintLogger implements LoggerInterface
{
    public function log(string $str)
    {
        echo $str;
    }
}

class NullLogger implements LoggerInterface
{
    public function log(string $str):void
    {
    }
}

$service = new Service(new PrintLogger());
$service->doSomething();

$service2 = new Service(new NullLogger());
$service2->doSomething();