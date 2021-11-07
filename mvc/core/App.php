<?php
class App
{

    protected $controller = "Home";
    protected $action = "SayHi";
    protected $params = [];

    function __construct()
    {

        $arr = $this->UrlProcess();

        // Controller
        $urlCheck = '';
        if (!empty($arr)) {
            foreach ($arr as $key => $item) {
                $urlCheck .= $item . '/';
                $fileCheck = rtrim($urlCheck, '/');
                $fileArr = explode('/', $fileCheck);
                $fileArr[count($fileArr) - 1] = ucfirst($fileArr[count($fileArr) - 1]);
                $fileCheck = implode('/', $fileArr);

                if (!empty($arr[$key - 1])) {
                    unset($arr[$key - 1]);
                }

                if (file_exists('mvc/controllers/' . ($fileCheck) . '.php')) {
                    $urlCheck = $fileCheck;
                    break;
                }
            }

            $arr = array_values($arr);
        }
        //Xử lý controller
        if (!empty($arr[0])) {
            $this->controller = ucfirst($arr[0]);
            unset($arr[0]);
        } else {
            $urlCheck  = $this->controller;
        }
        if (!file_exists('mvc/controllers/' . $urlCheck . '.php')) {
            $this->controller = "Error404";
            $urlCheck = $this->controller;
        }
        require_once 'mvc/controllers/' . $urlCheck . '.php';
        $this->controller = new $this->controller();
        // Action
        if (isset($arr[1])) {
            if (method_exists($this->controller, $arr[1])) {
                $this->action = $arr[1];
            }
            unset($arr[1]);
        }

        // Params
        $this->params = $arr ? array_values($arr) : [];

        call_user_func_array([$this->controller, $this->action], $this->params);
    }

    function UrlProcess()
    {
        if (isset($_GET["url"])) {
            return explode("/", filter_var(trim($_GET["url"], "/")));
        }
    }
}