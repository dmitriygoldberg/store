<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use app\controllers\ControllerFactory;

/**
 * Class App
 */
class App
{
    public static $params;

    public function __construct($config)
    {
        $this->routerInit($config);
        $this->databaseInit($config);
        self::$params = $config['params'];
    }

    /**
     * The entry point to the application.
     */
    public function run()
    {
        $this->handle(Router::getRoute());
    }

    /**
     * Checks for the existence of the controller and the called action.
     * If successful, it executes the controller action.
     * Otherwise, it redirects the data to the error page.
     * @param $route
     * @return bool
     */
    private function handle($route)
    {
        if (is_null($route)) {
            return $this->errorHandle();
        }

        $rt = explode('@', $route, 2);
        $controller = $rt[0];
        $action = isset($rt[1]) ? $rt[1] : null;
        $controllerObj = ControllerFactory::factory($controller);
        return method_exists($controllerObj, $action) ? $controllerObj->$action() : $this->errorHandle();
    }

    /**
     * In case of an error, redirects to 404 pages.
     * @return boolean
     */
    private function errorHandle()
    {
        $route = Router::getRoute('404');
        return $this->handle($route);
    }

    /**
     * Router initialization
     * @param array $config
     */
    private function routerInit(array $config)
    {
        if (isset($config['routes'])) {
            Router::setRoutes($config['routes']);
        }

        if (isset($config['aliases'])) {
            Router::setAliases($config['aliases']);
        }
    }

    /**
     * Database initialization
     * @param $config
     */
    private function databaseInit($config)
    {
        $capsule = new Capsule;
        $capsule->addConnection($config['db']);
        $capsule->bootEloquent();
    }
}