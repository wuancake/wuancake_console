<?php
/**
 * Created by PhpStorm.
 * User: ccc
 * Date: 2017/7/26 0026
 * Time: 15:15
 */

class Master extends User
{
    private $id       = '';
    private $name     = '';
    private $nickname = '';
    private $auth     = 0;


    /**
     * 登录
     * @param $name string 用户名
     * @param $psd mixed 密码
     */
    public function login($name, $psd) {

    }


    /**
     * */
    public function create_acc($name, $psd, $auth = 1, $group = 0) {

    }



}