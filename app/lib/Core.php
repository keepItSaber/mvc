<?php

//* Core App Class

class Core
{
    protected $currentController = 'Pages';
    protected $currentMethod = 'index';
    protected $params = [];

    public function __construct()
    {
        $url = $this->getUrl();

        //* Look in controllers folder for first value of url, ucwords capilize first letter
        if (file_exists('../app/controllers/' . ucwords($url[0]) . '.php')) {
            //* Settings existing controller;
            $this->currentController = ucWords($url[0]);
            unset($url[0]);
        }

        //* require controller

        require_once '../app/controllers/' . $this->currentController . '.php';

        $this->currentController = new $this->currentController;

        if (isset($url[1])) {
            if (method_exists($this->currentController, $url[1])) {
                $this->currentMethod = $url[1];
                unset($url[1]);
            }
        }

        //* Get params

        $this->params = $url ? array_values($url) : [];

        //* Callback for params array

        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }

    public function getUrl()
    {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            //? filtering variables as string/number
            $url = filter_var($url, FILTER_SANITIZE_URL);
            //? breaking to aray
            $url = explode('/', $url);
            return $url;
        }
    }
}
