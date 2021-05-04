<?php

class Sql
{
    /**
     * @var array
     */
    private $fields = [];

    /**
     * @var array
     */
    private $form = [];

    /**
     * @var array
     */
    private $where = [];
    
    public function select(array $fields):Sql
    {
        $this->fields = $fields;
        
        return $this;
    }

    public function from(string $table,string $alias):Sql
    {
        $this->form[] = $table."AS".$alias;
        
        return $this;
    }
    
    public function where(string $condition)
    {
        $this->where[] = $condition;
        
        return $this;
    }
    
    public function __toString():string
    {
        return sprintf(
            'SELECT %s FROM %s WHERE %s',
            join(',',$this->fields),
            join(',',$this->from),
            join('AND',$this->where)
        );
    }
}
$sql = new Sql();
$query = $sql->select(['foo','bar'])
            ->from('foobar','f')
            ->where('f.bar = ?');
echo '<pre>';
echo $query;