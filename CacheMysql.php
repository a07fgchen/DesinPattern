<?php

class CacheFactory
{
    public function createDriver($type, $setting)

    {
        $setting = $setting[$type];

        $className = 'Cache' . ucfirst(strtolower(($type)));

        $classFilePatch = __DIR__ . '/' . $className . '.php';

        if (file_exists($classFilePatch)) {
            include_once $classFilePatch;
        }

        return new $className($setting);
    }
}

class CacheMysql
{
    protected $db;
    protected $table;

    public function __construct($setting)
    {
        $host = 'mysql' .
            ':host=' . $setting['host'] .
            'dbname=' . $setting['dbnname'] .
            ';charset=' . $setting['charset'];
        $user = $setting['user'];
        $pass = $setting['pass'];

        $this->db = new PDO($host, $user, $pass);
        $this->table = $setting['table'];
    }

    public function get($key)
    {
        $sql = 'SELECT cache_value FROM' . $this->table . 'WHERE cahe_key = :cache_key';
        $query = $this->db->prepare($sql);
        $query->bindValue(':cache_key', $key);
        $query->execute();
        $resultData = $query->fetch($this->db::FETCH_ASSOC);
        if (!empty($resultData)) {
            return $resultData['cache_value'];
        }
        return false;
    }

    public function set($key, $value)
    {
        $cacheData = $this->get($key);

        $data = [
            'cache_key' => $key,
            'cache_value' => $value
        ];
        if ($cacheData !== false) {
            $sql = 'UPDATE ' . $this->table .
                'SET cache_value = :cache_value
            WHERE cache_key = :cache_key';

            $query = $this->db->prepare($sql);
            $query->execute($data);
        } else {
            $sql = 'INSERT INTO ' . $this->table . '(cache_key,cache_value)VALUES(:cache_key,:cache_value)';
            $query = $this->db->prepare($sql);
            $query->execute($data);
        }
    }
}
