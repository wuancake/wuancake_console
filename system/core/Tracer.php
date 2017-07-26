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

    //加载视图
    public function view($view,$data=array()){
        $str = file_get_contents('./application/views/'.$view.'.php');
        if (!empty($data))
            foreach ($data as $key=>$value){
            $str = str_replace("{"."$key"."}",$value,$str);
            //运用正则替换，把
            }
        ob_end_clean();
        echo $str;
    }


    /**
     * 跳转到指定页面
     * @param $page string 要跳转到的页面
     * @param $message string 错误信息
     */
    public function jump($page, $message) {
        echo '信息：' . $message;
        //head跳转
        exit();
    }
}