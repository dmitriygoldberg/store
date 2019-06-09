<?php

namespace app\controllers;

class ControllerFactory
{
    /**
     * Creates an instance of the called class.
     * @param string $controller
     * @return mixed
     */
    public static function factory($controller)
    {
        $className = "app\\controllers\\{$controller}";
        return class_exists($className) ? new $className() : null;
    }
}