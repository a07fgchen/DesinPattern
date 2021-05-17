<?php

/**
 * MediatorInterface 接口為Mediator類建立契約
 * 該接口雖非強制,但優於Liskov  原則
 */ 
interface MediatorInterface
{
    /**
     * 發出響應
     * 
     * @param string $content
     */
    public function sendReponse($content);

    /**
     * 做出請求
     */
    public function makeRequest();

    /**
     * 查詢資料庫 
     */
    public function queryDb();
}

class Mediator implements MediatorInterface
{
    /**
     * @var Subsystem\Server
     */
    private $server;
    
    /**
     * @var Database
     */
    private $database;
     /**
      * @var client
      */
    private $client;

    public function __construct(
        Database $database,
        Client $client,
        Server $server
        )
    {
        $this->database = $database;
        $this->server = $server;
        $this->client = $client;

        $this->database->setMediator($this);
        $this->server->setMediator($this);
        $this->client->setMediator($this);
    }

    public function makeRequest()
    {
        $this->server->process();
    }

    public function queryDb():string
    {
        return $this->database->getData();
    }

    /**
     * @param string $content
     */
    public function sendReponse($content)
    {
        $this->client->output($content);
    }
}

abstract class Colleague
{
    /**
     * 確保子類不變化
     */
    protected $mediator;

    /**
     * @param MediatorInterface $mediator
     */
    public function setMediator(MediatorInterface $mediator)
    {
        $this->mediator = $mediator;
    }
}

class Client extends Colleague
{
    public function request()
    {
        $this->mediator->makeRequest();
    }

    public function output(string $content)
    {
        echo $content;
    }
}

class Database extends Colleague
{
    public function getData():string
    {
        return 'World';
    }
}

class Server extends Colleague
{
    public function process()
    {
        $data = $this->mediator->queryDb();
        $this->mediator->sendReponse(
            sprintf("Hello %s",$data)
        );
    }
}


$client = new Client();
$client->setMediator(
    new Mediator(
        new Database(),
        $client,
        new Server()
    ));

$client->request();
