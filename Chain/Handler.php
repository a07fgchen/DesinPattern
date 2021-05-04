<?php

use Psr\Http\Message\RequestInterface;

abstract class Handler
{
    /**
     * @var Handler|null
     */
    private $successor = null;
    
    /**
     * 輸入集成處理器物件
     */
    public function __construct(Handler $handler = null)
    {
        $this->successor = $handler;
    }
    /**
     * 通過使用模板方法模式
     * 這種方法可以確保每個子類不會忽略調用繼承
     * 
     * @param RequestInterface $request
     * 定義處理請求方法
     * 
     * @return string|null
     */
    final public function handle(RequestInterface $request)
    {
        $processed = $this->processing($request);
        
        if($processed === null){
            //請求尚未被目前的處理器處理 => 傳遞到下一個處理器。
            if( $this->successor !== null ){
                $processed = $this->successor->handle($request);
            }
        }
        
        return $processed;
    }
    abstract protected function processing(RequestInterface $request);
}

class HttpInMemoryCacheHandler extends Handler
{
    /**
     * @var array
     */
    private $data;
    
    /**
     * @param array $data
     * 傳入資料陣列參數
     * @param Handler|null $successor
     * 傳入處理器對象$successor。
     */
    public function __construct(array $data,Handler $successor = null)
    {
        parent::__construct($successor);

        $this->data = $data;
    }
    
    /**
     * @param RequestInterface $request
     * 傳入請求類物件參數 $request
     * @return string|null
     */
    protected function processing(RequestInterface $request)
    {
        $key = sprintf(
            '%s?%s',
            $request->getUri()->getPath(),
            $request->getUri()->getQuery()
        );
        
        if( $request->getMethod() =='GET'&&
            isset($this->data[$key]) 
        ){
            return $this->data[$key];
        }
        return null;
    }
}

class SlowDatabaseHandler extends Handler
{
    /**
     * @param RequesInterface $request
     * 傳入請求類物件
     * @return string |null
     * 定義處理方法下面應該是資料庫成詢動作,但簡單模擬直接返回一個hello
     */
    public function processing(RequestInterface $request)
    {
        //這是一個模擬輸出
        return 'Hello';
    }
}

$chain = new HttpInMemoryCacheHandler(
    ['/foo/bar?index.php=1'=>'Hello In Memory!'],
    new SlowDatabaseHandler()
);
echo '<pre>';
var_dump(
    $chain
);