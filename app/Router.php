<?php

/**
 * Class Router
 */
class Router
{
    private static $routes;
    private static $aliases;

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    /**
     * Set routes
     * @param array $routes
     */
    public static function setRoutes(array $routes)
    {
        self::$routes = $routes;
    }

    /**
     * Set Aliases
     * @param array $aliases
     */
    public static function setAliases(array $aliases)
    {
        self::$aliases = $aliases;
    }

    /**
     * Return controller and action of current route
     * @param null $route
     * @return string|null
     */
    public static function getRoute($route = null)
    {
        $uri = is_null($route) ? strtok($_SERVER['REQUEST_URI'], '?') : $route;
        if ($uri == '/index.php') {
            $uri = '/';
        }

        return isset(self::$routes[$uri]) ? self::$routes[$uri] : null;
    }

    /**
     * Return url by alias
     * @param string $alias
     * @param array $params
     * @return string
     */
    public static function getUrl($alias, $params = [])
    {
        $query = !empty($params) ? '?' . http_build_query($params) : '';
        return isset(self::$aliases[$alias]) ? self::$aliases[$alias] . $query : '#';
    }
}