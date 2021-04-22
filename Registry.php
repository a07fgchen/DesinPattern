<?php
namespace Design;
//註冊模式

class Registry
{
    /**
     * 存放物件的容器
     * 
     * @param array
     */
    private static $instances = [];

    /**
     * 判斷是否有物件
     */
    public static function has($name)
    {
        if (isset(self::$instances[$name])) {
            return true;
        }
        return false;
    }
    /**
     * 從註冊表取得物件
     * 
     * @param string $name 物件的名稱
     * 
     * @return mixed
     */
    public static function get($name)
    {
        if (!self::has($name)) {
            throw new \Exception('此 物件未被註冊');
        }

        return self::$instances[$name];
    }

    /**
     * 儲存物件至註冊表中
     * 
     * @param object $obj 要存入的物件實例
     * @param string $name 代表此物件的名稱
     * 
     * @return void
     */
    public static function set($obj, string $name = '')
    {
        //假如沒有指定名稱,則使用該物件類別的名稱

        if (empty($name)) {
            $name = strtolower(get_class());
        }

        if (self::has($name)) {
            return;
        }

        self::$instances[$name] = $obj;
    }
    /**
     *  
     */
    public static function remove($name)
    {
        if( self::has($name) ){
            unset(self::$instances[$name]);
        }
    }
}

