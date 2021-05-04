<?php

/**
 * 創建基礎輸入輸出BiosInterface
 */
interface BiosInterface
{
    /**
     * 聲明執行方法
     */
    public function execute();

    /**
     * 聲明等待密碼輸入方法
     */
    public function waitForKeyPress();
    
    public function launch(OsInterface $os);
    /**
     * 聲明關機方法。
     */
    public function powerDown();
}