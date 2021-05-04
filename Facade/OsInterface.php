<?php

interface OsInterface
{
    /**
     * 聲明關機方法。
     */
    public function halt();
    /**
     * 聲明獲取名稱方法,返回字串格式數據。
     */
    public function getName():string;
}