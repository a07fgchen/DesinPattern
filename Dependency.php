<?php

interface RedisInterface
{
    public function get($key);

    public function set($key, $value);
}

class Redis implements RedisInterface
{
    public function get($key)
    {
    }

    public function set($key, $value)
    {
    }
}

class PredisEXT extends Redis implements RedisInterface
{
    protected $db;

    public function __construct($setting)
    {
        $this->db = new \Predis\Client($setting);
    }
    
    public function get($key)
    {
        return $this->db->get($key);
    }

    public function set($key, $value)
    {
        return $this->db->set($key, $value);
    }
}

class CacheRedis
{
    protected $db;

    public function __construct(RedisInterface $redis)
    {
        $this->db = $redis;
    }

    public function get()
    {
        return $this->db;
    }

    public function set($key, $value)
    {
        return $this->db->set($key, $value);
    }
}
