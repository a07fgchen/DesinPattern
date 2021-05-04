<?php

class Book 
{
    /**
     * @var string 
     */
    private $author;

    /**
     * @var string
     */
    private $title;

    public function __construct(string $title,string $author)
    {
        $this->author = $author;
        $this->title = $title;
    }

    public function getAuthor():string
    {
        return $this->author;
    }
    
    public function getTitle():string
    {
        return $this->author;
    }

    public function getAuthorAndTitle():string
    {
        return $this->getTitle().' by '.$this->getAuthor();
    }
}

class BookList implements \Countable,\Iterator
{
    /**
     * @var Book[]
     */
    private $books = [];
    
    /**
     * @var int
     */
    private $currentIndex = 0;
    
    public function addBook(Book $book)
    {
        $this->books[] = $book;
    }

    public function removeBook(Book $bookToRemove)
    {
        foreach($this->books as $key =>$book){
            if( 
                $book->getAuthorAndTitle() === 
                $bookToRemove->getAuthorAndTitle() 
            ){
                unset($this->books[$key]);
            }
        }
        
        $this->books = array_values($this->books);
    }

    public function count():int
    {
        return count($this->books);
    }

    public function current():Book
    {
        return $this->books[$this->currentIndex];
    }

    public function key():int
    {
        return $this->currentIndex;
    }

    public function next()
    {
        return $this->currentIndex++;
    }

    public function rewind()
    {
        $this->currentIndex = 0;
    }

    public function valid():bool
    {
        return isset($this->books[$this->currentIndex]);
    }
}

$booklist = new BookList();
$booklist->addBook(new Book(
    'Learning PHP Design Patterns'
    ,'William Sanders')
);

$booklist->addBook(new Book(
    'Professional PHP Design Patterns'
    ,'Aaron Saray')
);
$rober = new Book(
    'Clear Code'
    ,'Rebert C. Martin');
$booklist->addBook(
    $rober
);

echo "<pre>";

var_dump( $booklist );

foreach($booklist as $book)
{
    echo $book->getAuthorAndTitle().PHP_EOL; 
}

$booklist->removeBook($rober);

foreach($booklist as $book)
{
    echo $book->getAuthorAndTitle().PHP_EOL; 
}