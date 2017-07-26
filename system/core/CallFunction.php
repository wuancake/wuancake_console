<?php
/**
 * Created by PhpStorm.
 * User: ccc
 * Date: 2017/7/12 0012
 * Time: 17:15
 */
    require_once './system/core/Tracer.php';
    require_once './system/core/TracerModels.php';

    //调用自动加载
    spl_autoload_register(function ($class){
        if (!class_exists($class)){
            require_once ('./application/controllers/'.ucfirst($class).'.php');
        }
    });

    //获取URL中的信息
    $info = array_filter(explode('/',$_SERVER['REQUEST_URI']));
    foreach ($info as $key=>$value){
        if ($value !== 'index.php')
            unset($info[$key]);
        else
            break;
    }

    //获取要调用的类,如果没有指定要调用的类，则默认为index类
    if (sizeof($info) === 1)
        $class = 'index';
    else
        $class = implode(array_slice($info,1,1));

    //获取要调用的函数，如果没有指定要调用的方法，则默认为index方法
    if (sizeof($info) === 2 || sizeof($info) ===1)
        $function = 'index';
    else
        $function = implode(array_slice($info,2,1));

    //获取URL中的参数
    $parameter = array_slice($info,3);

    //调用
    $exc = new $class();
    call_user_func_array(array($exc,$function),$parameter);
