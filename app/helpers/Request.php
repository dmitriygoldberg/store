<?php


namespace app\app\helpers;

/**
 * Class for working with requests
 * @package app\app\helpers
 */
class Request
{
    /**
     * @param mixed $var
     * @return mixed|null
     */
    public static function get($var)
    {
        return isset($_REQUEST[$var]) ? $_REQUEST[$var] : null;
    }
}