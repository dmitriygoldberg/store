<?php

namespace app\controllers;

/**
 * Class Controller
 * @package app\controllers
 */
abstract class Controller
{
    private $rootPath;
    private $viewsPath;

    public function __construct()
    {
        $this->rootPath = \App::$params['basePath'];
        $this->viewsPath = $this->rootPath . \App::$params['viewsPath'];
    }

    /**
     * Passes the parameters to the view and displays the page.
     * @param string $view
     * @param array $params
     */
    protected function render(string $view, array $params = [])
    {
        foreach ($params as $key => $value) {
            ${$key} = $value;
        }

        include_once($this->viewsPath . '/' . $view . '.php');
    }

    /**
     * Generates a response to the ajax-request.
     * If the request is handled successfully, it returns an array:
     * [success => true, data => array]
     * Else:
     * [success => false, errors => array]
     * @param array $data
     * @param bool $success
     */
    protected function ajaxResponse(array $data = [], bool $success = true)
    {
        $word = $success ? 'data' : 'errors';
        echo json_encode(['success' => $success, $word => $data], JSON_UNESCAPED_UNICODE);
    }
}