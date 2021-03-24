<?php
ini_set('display_errors','1');
error_reporting(E_ALL);
include_once './registry.php';

use Design\Registry;

trait singleton
{
    private function __construct()
    {

    }

    public static function getInstance()
    {
        $name = strtolower(get_called_class());
        $name = ltrim(substr($name, strrpos($name, '\\')), '\\');
        if( !Registry::has($name) ){
            $instance = new self();
            Registry::set($instance,$name);
        }
        
        return Registry::get($name);
    }
}

class Woman
{
    use singleton;
    
}

$woman = Woman::getInstance();
var_dump($woman);
$registryWoman = Registry::get('woman');
var_dump($registryWoman);
