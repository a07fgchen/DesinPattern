<?php

interface CommandInterface
{
    /**
     * 這是在命令行模式中很重要的方法
     * 這個接受者會被載入構造器
     */
    public function execute();
}

class HelloCommand implements CommandInterface
{
    /**
     * @var Receiver
     */
    private $output;
    
    /**
     * 每個具體的命令都來自於不同的接受者。
     * 這個可以是一個或者多個接受者,但是參數裡必須是可以被執行的命令。
     * 
     * @param Reiver $console
     */
    public function __construct(Receiver $console)
    {
        $this->output= $console;
    }

    /**
     * 執行和輸出 "Hello World"
     */
    public function execute()
    {
        $this->output->write('Hello World');
    }
}

class Receiver
{
    /**
     * @var bool
     */
    private $enbleData = true;
    
    /**
     * @var string[]
     */
    private $output = [];

    /**
     * @param string $str
     */
    public function write(string $str)
    {
        if( $this->enbleData ){
            $str .= '['.date('Y-m-d').']';
        }
        
        $this->output[] = $str;
    }

    public function getOutput():string
    {
        return join('\n',$this->output);
    }

    /**
     * 可以顯示消息的時間
     */
    public function enbleData()
    {
        $this->enbleData = true;
    }

    /**
     * 禁止顯示消息的時間
     */
    public function disableDate()
    {
        $this->enbleData = false;
    }
}

class Invoker
{
    /**
     * @var CommandInterface
     */
    private $command;

    /**
     * 在這種調用者中,我們發現,訂閱命令也是種方法
     * 還包括:堆疊,列表,集合等等
     * 
     * @param CommandInterface $cmd
     */
    public function setCommand(CommandInterface $cmd)
    {
        $this->command = $cmd;
    }

    /**
     * 執行這個命令;
     * 調用者也是用這個命令
     */
    public function run()
    {
        $this->command->execute();
    }
}

$invoker = new Invoker();
$recevier = new Receiver();
$hello = new HelloCommand($recevier);
// $invoker->setCommand($hello);
// $invoker->run();
echo "<pre>";
var_dump($hello->execute());
var_dump($recevier->getOutput());