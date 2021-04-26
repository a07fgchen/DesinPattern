<?php
ini_set('display_errors','1');
error_reporting(E_ALL);

include_once './CacheMysql.php';

$setting['mysql']['host'] = '127.0.0.1';
$setting['mysql']['dbname'] = 'test';
$setting['mysql']['charset'] = 'UTF8';
$setting['mysql']['user'] = 'shieldon';
$setting['mysql']['pass'] = 'taiwan';
$setting['mysql']['table'] = 'cache_da
ta';

$setting['mysql']['host'] = '127.0.0.1';
$setting['mysql']['port'] = '6379';

$factory = new CacheFactory();

$cache = $factory->createDriver('mysql',$setting);

$cache->set('hello','world');
echo $cache->get('hello');