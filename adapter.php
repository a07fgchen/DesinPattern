<?php

namespace DesignPatterens\Adapter;

interface BookInterface
{
    public function turnPage();

    public function open();

    public function getPage():int;
}
interface EBookInterface
{
    public function unlock();

    public function pressNext();
    
    /**
     * 返回當前頁和總頁數,像[10,100] 是總頁數中的第10頁
     * 
     * @return int[]
     */
    public function getPage():array;
}
class Book implements BookInterface
{
    /**
     * @var int
     */
    private $page;
    
    public function open()
    {
        $this->page = 1;
    }

    public function turnPage()
    {
        $this->page++;
    }

    public function getPage(): int
    {
        return $this->page;
    }
}

class EBookAdapter implements BookInterface
{
    /**
     * @var EBookInterface
     */
    protected $ebook;

    /**
     *  @param EBookInterface $eBook
     */
    public function __construct(EBookInterface $eBook)
    {
        $this->ebook = $eBook;
    }

    /**
     * 這個類使接口進行適當的轉換
     */
    public function open()
    {
        $this->ebook->unlock();
    }
    
    public function turnPage()
    {
        $this->ebook->pressNext();
    }

    /**
     * 注意這裡的配接器行為: EBookInterface::getpage() 將返回兩個整數,
     * 除了BookInterface,僅支持獲得當前頁,所以我們這裡配接這個行為
     * 
     * @return int
     */
    public function getPage():int
    {
        return $this->ebook->getPage()[0];
    }
}

class Kindle implements EBookInterface
{
    /**
     * @var int
     */
    private $page = 1;

    /**
     * @var int
     */
    private $totalPages = 100;

    public function pressNext()
    {
        $this->page++;
    }

    public function unlock()
    {
        
    }
    /**
     * 返回當前頁和總頁數,像[10,100]是總頁數中的第10頁
     * 
     * @return int[]
     */
    public function getPage():array
    {
        return [$this->page,$this->totalPages];
    }
}

$book = new Book();
$book->open();
var_dump($book->getPage());
$book->turnPage();
var_dump($book->getPage());
$eBook = new Kindle();
$eBook->pressNext();
var_dump($eBook->getPage());

$e = new EBookAdapter($eBook);
var_dump($e->getPage());
