<?php

class Event 
{
    /**
     * 儲存callback的陣列
     * 
     * @var array
     */
    protected static $event = [];

    /**
     * 註冊事件
     * 
     * @param string $name 事件名稱
     * @param mixed $callback 可執行或閉包 
     */
    public static function addListener($name,$callback)
    {
        $name = strtolower($name);
        self::$event[$name][] = $callback;
    }

    /**
     * 觸發事件
     * 
     * @param string $name 事件名稱
     * @param mixed $args 傳給回呼函式的參數
     * 
     * @return void
     */

     public static function trigger($name,$argc)
     {
         $name = strtolower($name);
         
         if( self::has($name) ){
            foreach(self::$event[$name] as $func){
                $func($argc);
            }
         }
     }
     
     /**
      * 檢查事件是否存在
      * @param string $name 事件名稱
      * 
      * @return bool
      */
      public static function has($name)
      {
          if(isset(self::$event[$name])){
              return true;
          }
          
          return false;
      }
}


Event::addListener('day9_event',function($argc){
   if( $argc ){
       echo 'Hello, '.$argc.'.';
   }else{
       echo 'Hello, world.';
   } 
});
Event::addListener('day9_event',function($argc){
   if( $argc ){
       echo 'Hello, '.$argc.'.';
   }else{
       echo 'Hello, world.';
   } 
});

Event::trigger('day9_event','Taiwan');