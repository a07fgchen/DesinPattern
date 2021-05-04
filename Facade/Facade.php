<?php
class Facade
{
    /**
     * @var Osinterface
     */
    private $os;

    /**
     * @var BiosInterface
     */
    private $bios;
    
    /**
     * @param BiosInterface $bios
     * @param Osinterface $os
     * 傳入基礎輸入的系統接口物件 $bios。
     * 傳入操作系統接口物件 $os。
     */
    public function __construct(BioInterface $bios,OsInterface $os)
    {
        $this->bios = $bios;
        $this->os = $os;
    }

    /**
     * 構建基礎輸入輸出系統執行啟動方法
     */
    public function turnOn()
    {
        $this->bios->execute();
        $this->bios->waitForKeyPress();
        $this->bios->launch($this->os);
    }

    /**
     * 構建系統關閉方法。
     */
    public function turnOff()
    {
        $this->os->halt();
        $this->bios->powerDown;
    }
}