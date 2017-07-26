<?php

/**
 * Created by PhpStorm.
 * User: ccc
 * Date: 2017/7/12 0012
 * Time: 16:57
 */
class Tracer
{
    protected $db = '';

    //获取post数据
    public function post($aim = ''){
        if (empty($aim))
            return $_POST;
        elseif (isset($_POST[$aim]))
            return $_POST[$aim];
        else
            $this->jump('','请求错误，必要参数不存在');
    }

    //获取get数据
    public function get($aim = ''){
        if (empty($aim))
            return $_GET;
        elseif (isset($_GET[$aim]))
            return $_GET[$aim];
        else
            return false;
    }

    //加载model
    public function database($db){
        require_once './application/models/'.ucfirst($db).'Model.php';
        $db = ucfirst($db).'Model';
        $this->db = new $db;
    }

    /**
     * 加载视图
     * @param $view string 要加载的界面
     * @param $data array 要传递的数据
     */
    public function view($view,$data=array()){
        @extract($data);
        ob_end_clean();
        require_once './application/views/'.$view.'.php';
    }


    /**
     * 跳转到指定页面
     * @param $page string 要跳转到的页面
     * @param $message mixed 错误信息
     */
    public function jump($page, $message='') {
        ob_end_clean();
        require_once './application/views/'.$page.'.php';
        exit();
    }
}