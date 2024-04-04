<?php

class App {
    protected $controller = 'AuthController';
    protected $method = 'login'; // Mặc định action là 'login'
    protected $params = [];

    public function __construct() {
        $url = $this->parseUrl();

        if ($url !== null && file_exists('../app/controllers/' . ucfirst($url[0]) . '.php')) {
            $this->controller = ucfirst($url[0]);
            unset($url[0]);
        }

        require_once '../app/controllers/' . $this->controller . '.php';
        $this->controller = new $this->controller;

        $methodToCall = isset($url[1]) ? $url[1] : $this->method;

        if (method_exists($this->controller, $methodToCall)) {
            $this->method = $methodToCall;
            unset($url[1]);
        }

        $this->params = $url ? array_values($url) : [];

        // Gọi phương thức của controller với các tham số tương ứng
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parseUrl() {
        if (isset($_GET['url'])) {
            $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
            return array_values(array_filter($url));
        }
        return null;
    }
}
?>
