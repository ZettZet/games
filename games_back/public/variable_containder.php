<?php

class VC
{
    private static $container = [];

    public static function get(string $var)
    {
        return self::$container[$var];
    }

    public static function set(string $var, $val)
    {
        self::$container[$var] = $val;
    }
}
