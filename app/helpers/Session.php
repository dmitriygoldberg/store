<?php


namespace app\app\helpers;

/**
 * Class for working with sessions
 * @package app\app\helpers
 */
class Session
{
    /**
     * @param mixed $var
     * @return mixed|null
     */
    public static function get($var)
    {
        return isset($_SESSION[$var]) ? $_SESSION[$var] : null;
    }

    /**
     * @param mixed $var
     * @param mixed $value
     */
    public static function set($var, $value)
    {
        $_SESSION[$var] = $value;
    }

    /**
     * @param mixed $var
     */
    public static function delete($var)
    {
        if (isset($_SESSION[$var])) {
            unset($_SESSION[$var]);
        }
    }
}