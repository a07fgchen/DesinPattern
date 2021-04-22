<?php
ini_set('display_errors', '1');
error_reporting(E_ALL);


use PHPUnit\Framework\TestCase;

/**
 * Class Turnips
 */

final class Turnips
{
    /**
     * @var Turnips
     */
    protected static $turnips;

    private function __construct()
    {
    }
    private function __clone()
    {
    }
    private function __wakeup()
    {
    }

    public static function getTurnips(): Turnips
    {
        if (static::$turnips === null) {
            static::$turnips = new static();
        }

        return static::$turnips;
    }
}
