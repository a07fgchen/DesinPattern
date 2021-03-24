<?php
//單例 

trait single
{
      
    private static $instance;

    private function __construct()
    {
        
    }

    public static function getInstance()
    {
        if( !self::$instance ){
            self::$instance = new self();
        }
        return self::$instance;
    }
    
}


class Man
{
    use single;
    
    protected $age = 0;

    public function get()
    {
        return $this->age;
    }
    
    public function set($age)
    {
        $this->age = $age;
    }

}

$man = Man::getInstance();

$man->get();

$man->set(12);

echo $man->get()."<br>";

$man2 = Man::getInstance();
//與man同一個實體
echo $man2->get()."<br>";